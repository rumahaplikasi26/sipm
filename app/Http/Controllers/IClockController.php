<?php

namespace App\Http\Controllers;

use App\Jobs\AttendanceJob;
use App\Jobs\AttendanceSyncJob;
use App\Models\ConfigAttendance;
use App\Models\Employee;
use App\Models\User;
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
            //  "TimeZone=7\r\n" .
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
        try {
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

                $is_active = false;

                if ($employee != null) {
                    $name = $employee->name;
                    $phone = $employee->phone;
                    $is_active = true;
                } else {
                    $employee = Employee::updateOrCreate([
                        'employee_id' => $data[0]
                    ], [
                        'name' => $data[0],
                    ]);

                    $name = $employee->name;
                    $is_active = false;
                }

                $attendanceData = [
                    'uid' => $data[0] . date('dHi'),
                    'employee_id' => $data[0],
                    'state' => $data[3],
                    'timestamp' => $data[1],
                    'name' => $name,
                    'phone' => $phone,
                    'group_id' => $employee->group_id,
                    'position_id' => $employee->position_id,
                    'is_active' => $is_active,
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
}
