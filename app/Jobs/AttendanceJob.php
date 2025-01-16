<?php

namespace App\Jobs;

use App\Events\AttendanceUpdated;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
class AttendanceJob implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue, Dispatchable;

    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = $this->data;

        try {
            $employeeExists = Employee::where('id', $data['employee_id'])->first();

            if (empty($employeeExists)) {
                \Log::info('Employee not found', $data);
                return;
            }

            $isFirstAttendance = Attendance::whereDate('timestamp', date('Y-m-d', strtotime($data['timestamp'])))
                ->where('employee_id', $data['employee_id'])->first();

            if (empty($isFirstAttendance)) {
                if ($data['is_active'] == true) {
                    $activeActivity = Activity::with('scope', 'group', 'supervisor')
                        ->where('group_id', $data['group_id'])
                        ->where('position_id', $data['position_id'])
                        ->whereDate('date', date('Y-m-d', strtotime($data['timestamp'])))
                        ->first();

                    if ($data['phone'] != null && $activeActivity != null) {
                        // Send Activity Notification di ambil dari variabel $activeActivity title, date, scope->name, group->name, forecast_date, plan_date, actual_date, description, supervisor->name buat kalimat pesannya
                        $message = "Dear {$data['name']}, Anda memiliki aktivitas berikut:\n" .
                            "Judul: {$activeActivity->title}\n" .
                            "Tanggal: {$activeActivity->date}\n" .
                            "Scope: {$activeActivity->scope->name}\n" .
                            "Grup: {$activeActivity->group->name}\n" .
                            "Deskripsi: {$activeActivity->description}\n" .
                            "Supervisor: {$activeActivity->supervisor->name}";

                        $this->sendWhatsAppNotification($data['phone'], $message);
                        \Log::info(date('Y-m-d H:i:s') . ' ' . 'Sent Whatsapp ' . $data['phone'] . ' Successfully');
                        \Log::info(date('Y-m-d H:i:s') . ' ' . 'Attendance Sync Job Completed With Send Activity Successfully');
                    }
                }
            }

            $attendance = Attendance::updateOrCreate(
                ['uid' => $data['uid']],
                [
                    'employee_id' => $data['employee_id'],
                    'state' => $data['state'],
                    'timestamp' => $data['timestamp'],
                ]
            );

            \Log::info(date('Y-m-d H:i:s') . ' ' . 'Attendance Sync Job Completed Successfully');
        } catch (\Throwable $th) {
            \Log::error(date('Y-m-d H:i:s') . ' ' . $th->getMessage());
        }
    }

    /**
     * Mengirim notifikasi WhatsApp
     */
    private function sendWhatsAppNotification($phoneNumber, $message)
    {
        try {
            $no_hp = $phoneNumber; // No.HP yang dikirim (No.HP Penerima)

            // Memastikan nomor telepon menggunakan awalan 62
            if (substr($no_hp, 0, 1) == '0') {
                $no_hp = '62' . substr($no_hp, 1); // Mengganti 0 dengan 62
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://app.wapanels.com/api/create-message',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'appkey' => '591d8e3f-1d20-4ebb-9eaa-ecc76507669f',
                    'authkey' => 'kt0xK5HWormDW4GwdO1NHq9hiEvNOIdEd7d2XfmUjLRS1IkKQs',
                    'to' => $no_hp,
                    'message' => $message,
                    'sandbox' => 'false'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            \Log::info('WhatsApp Notification Sent', ['response' => $response]);
            return $response;
        } catch (\Throwable $th) {
            \Log::error(date('Y-m-d H:i:s') . ' ' . $th->getMessage());
        }
    }
}
