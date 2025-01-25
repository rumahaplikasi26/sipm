<?php

namespace App\Http\Controllers;

use App\Jobs\AttendanceJob;
use App\Jobs\AttendanceSyncJob;
use App\Models\ConfigAttendance;
use App\Models\Employee;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isTrue;

class IClockController extends Controller
{
    public function __invoke(Request $request)
    {
    }

    public function handshake(Request $request)
    {
        $r = "GET OPTION FROM: {$request->input('SN')}\r\n" .
            "Stamp=9999\r\n" .
            "OpStamp=" . time() . "\r\n" .
            "ErrorDelay=60\r\n" .
            "Delay=30\r\n" .
            "ResLogDay=18250\r\n" .
            "ResLogDelCount=10000\r\n" .
            "ResLogCount=50000\r\n" .
            "TransTimes=00:00;14:05\r\n" .
            "TransInterval=1\r\n" .
            "TransFlag=1111000000\r\n" .
            "TimeZone=7\r\n" .
            "Realtime=1\r\n" .
            "Encrypt=0";

        \Log::info('Handshake', $request->all());
        return $r;
    }

    public function test(Request $request)
    {
        \Log::info('Test', $request->all());
    }

    public function receiveRecords(Request $request)
    {
        \Log::info('Receive Records', $request->all());
        // return "OK: 0";

        try {
            $sn = $request->input('SN');
            $arr = preg_split('/\\r\\n|\\r|,|\\n/', $request->getContent());

            $tot = 0;

            //operation log
            if ($request->input('table') == "OPERLOG") {
                foreach ($arr as $rey) {
                    if (isset($rey)) {
                        $tot++;
                    }
                }

                \Log::info('Operation Log', $request->all());
                return "OK: " . $tot;
            }

            //attendance
            foreach ($arr as $rey) {
                if (empty($rey)) {
                    continue;
                }

                $data = explode("\t", $rey);

                $time = date('H:i:s', strtotime($data[1]));

                $employee = $this->getEmployee($data[0]);

                $name = '';
                $phone = '';
                $shift = null;

                $is_active = false;

                if ($employee != null) {
                    $name = $employee->name;
                    $phone = $employee->phone;
                    $is_active = true;
                } else {
                    $employee = Employee::updateOrCreate([
                        'id' => $data[0]
                    ], [
                        'name' => $data[0],
                    ]);

                    $name = $employee->name;
                    $is_active = false;
                }

                // Cari shift berdasarkan tanggal atau hari
                $dayOfWeek = Carbon::parse($data[1])->format('l'); // Mendapatkan nama hari

                // Ambil semua shift yang berlaku untuk hari tersebut
                $shifts = Shift::where('day_of_week', strtolower($dayOfWeek))->get();

                if ($shifts->isNotEmpty()) {
                    foreach ($shifts as $potentialShift) {
                        // Validasi apakah fingerprint sesuai dengan waktu shift
                        if ($this->isValidFingerprintTime($data[1], $potentialShift)) {
                            $shift = $potentialShift->id; // Pilih shift yang sesuai
                            break; // Berhenti pada shift pertama yang valid
                        }
                    }
                }

                $attendanceData = [
                    'sn' => $sn,
                    'uid' => $data[0] . date('dHi'),
                    'employee_id' => $data[0],
                    'state' => $data[2],
                    'timestamp' => $data[1],
                    'name' => $name,
                    'phone' => $phone,
                    'group_id' => $employee->group_id,
                    'position_id' => $employee->position_id,
                    'is_active' => $is_active,
                    'shift_id' => $shift
                ];

                AttendanceJob::dispatch($attendanceData);
                $tot++;

                \Log::info('Attendance Data', $attendanceData);
            }

            \Log::info('Receive Records', $request->all());
            return "OK: " . $tot;
        } catch (Exception $e) {
            \Log::error('Error', $e->getMessage());
            return "ERROR: " . $tot . "\n";
        }
    }

    public function getrequest(Request $request)
    {
        // \Log::info('Get Request', $request->all());
        return "OK";
    }

    protected function getEmployee($id)
    {
        return Employee::find($id) ?? null;
    }

    public function testAttendance(Request $request)
    {
        try {
            $shift = null;

            // Cari shift berdasarkan tanggal atau hari
            $dayOfWeek = Carbon::parse($request->datetime)->format('l'); // Mendapatkan nama hari

            // Ambil semua shift yang berlaku untuk hari tersebut
            $shifts = Shift::where('day_of_week', strtolower($dayOfWeek))->get();

            if ($shifts->isNotEmpty()) {
                foreach ($shifts as $potentialShift) {
                    // Validasi apakah fingerprint sesuai dengan waktu shift
                    if ($this->isValidFingerprintTime($request->datetime, $potentialShift)) {
                        $shift = $potentialShift->id; // Pilih shift yang sesuai
                        break; // Berhenti pada shift pertama yang valid
                    }
                }
            }

            $attendanceData = [
                'sn' => 'TESTSN',
                'uid' => 'test' . date('dHi'),
                'employee_id' => $request->employee_id,
                'state' => 1,
                'timestamp' => $request->datetime,
                'name' => 'Achmad Fatoni',
                'phone' => '6289676490971',
                'group_id' => 1,
                'position_id' => 1,
                'is_active' => 1,
                'shift_id' => $shift
            ];

            AttendanceJob::dispatch($attendanceData);

            return "OK";
        } catch (Exception $e) {
            \Log::error('Error', $e->getMessage());
            return "ERROR";
        }
    }

    // Fungsi untuk mengecek apakah waktu fingerprint sesuai dengan shift
    protected function isValidFingerprintTime($timestamp, $shift)
    {
        $time = Carbon::parse($timestamp);

        // Parse start and end adjustments as Carbon instances with dynamic dates based on the timestamp's date
        $startAdjustment = Carbon::parse($time->toDateString() . ' ' . $shift->start_adjustment);
        $endAdjustment = Carbon::parse($time->toDateString() . ' ' . $shift->end_adjustment);

        // Handle cases where end time is earlier than start time (crosses midnight)
        if ($endAdjustment->lt($startAdjustment)) {
            $endAdjustment = $endAdjustment->addDay(); // Add one day if it crosses midnight
        }

        // Adjust to previous day for timestamps in early morning (00:00 - 05:59)
        if ($time->hour < 6) {
            // If timestamp is between midnight and 5 AM, adjust the start and end for the previous day
            $startAdjustment = $startAdjustment->subDay();
            $endAdjustment = $endAdjustment->subDay();
        }

        // Debugging logs
        \Log::info('Checking Shift ID: ' . $shift->id);
        \Log::info('Timestamp: ' . $time);
        \Log::info('Start Adjustment: ' . $startAdjustment);
        \Log::info('End Adjustment: ' . $endAdjustment);

        // Check if the timestamp falls within the range
        if ($time->between($startAdjustment, $endAdjustment)) {
            \Log::info('Valid Shift Found: ' . $shift->id);
            return true;
        }

        return false;
    }

}
