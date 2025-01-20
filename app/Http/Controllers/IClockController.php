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

                // Ambil shift yang berlaku untuk hari tersebut
                $shift = Shift::where('day_of_week', strtolower($dayOfWeek))->first();

                // Jika shift tidak ditemukan, bisa memilih shift default
                if ($shift) {
                    // Pastikan fingerprint masuk dalam waktu shift
                    $isValidTime = $this->isValidFingerprintTime($data[1], $shift);

                    if ($isValidTime) {
                        $shift = $shift->id;
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
            $attendanceData = [
                'uid' => 'test',
                'employee_id' => 20221224,
                'state' => 1,
                'timestamp' => date('Y-m-d H:i:s'),
                'name' => 'Nurul',
                'phone' => '6289676490971',
                'group_id' => 1,
                'position_id' => 1,
                'is_active' => 1,
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

        // Validasi waktu berdasarkan shift
        if ($time->between($shift->start_time, $shift->break_start_time)) {
            return true; // Jam masuk
        } elseif ($time->between($shift->break_end_time, $shift->end_time)) {
            return true; // Jam pulang
        }

        return false; // Tidak valid
    }
}
