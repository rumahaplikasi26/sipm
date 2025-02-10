<?php

namespace App\Console\Commands;

use App\Jobs\SendWhatsappJob;
use App\Models\ActivityIssue;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckUnresolvedIssues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:checkunresolved';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for unresolved issues to Project Manager and Project Director';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        try {
            // Notifikasi ke Project Manager jika lebih dari 30 menit
            $issuesForPM = ActivityIssue::whereNull('resolved_at')
                ->where('created_at', '<=', $now->subMinutes(30))
                ->whereNull('notified_project_manager_at') // Cegah pengiriman berulang
                ->get();

            foreach ($issuesForPM as $issue) {
                $activity = $issue->activity;
                $supervisorName = $activity->supervisor ? $activity->supervisor->name : 'Unknown Supervisor';
                $message = "🔔 *Reminder: Issue Pending for 30 Minutes!*\n\n"
                    . "*Scope:* {$activity->scope->name}\n"
                    . "*Area:* {$activity->area->name}\n"
                    . "*Posisi:* {$activity->position->name}\n"
                    . "*Planned Date:* {$activity->plan_date}\n"
                    . "*Supervisor:* {$supervisorName}\n\n"

                    . "*Date:* {$issue->date}\n"
                    . "*Category Dependency:* {$issue->categoryDependency->name}\n"
                    . "*Percentage Dependency:* {$issue->percentage_dependency}%\n\n"
                    . "Please follow up with the Site Manager and update solution as soon as possible.";

                // $projectManagers = User::role('Project Manager')->get();
                $projectManagers = User::where('id', 1)->get();
                foreach ($projectManagers as $pm) {
                    \Log::info('Message sent to Project Manager: ' . $pm->name);
                    SendWhatsappJob::dispatch($pm->phone, $message);
                }

                $issue->update(['notified_project_manager_at' => $now]);
            }

            // Notifikasi ke Project Director jika lebih dari 5 jam
            $issuesForPD = ActivityIssue::whereNull('resolved_at')
                ->where('created_at', '<=', $now->subHours(5))
                ->whereNull('notified_project_director_at') // Cegah pengiriman berulang
                ->get();

            foreach ($issuesForPD as $issue) {
                $activity = $issue->activity;
                $supervisorName = $activity->supervisor ? $activity->supervisor->name : 'Unknown Supervisor';

                $message = "🚨 *Urgent: Issue Pending for Over 5 Hours!*\n\n"
                    . "*Scope:* {$activity->scope->name}\n"
                    . "*Area:* {$activity->area->name}\n"
                    . "*Posisi:* {$activity->position->name}\n"
                    . "*Planned Date:* {$activity->plan_date}\n"
                    . "*Supervisor:* {$supervisorName}\n\n"

                    . "*Date:* {$issue->date}\n"
                    . "*Category Dependency:* {$issue->categoryDependency->name}\n"
                    . "*Percentage Dependency:* {$issue->percentage_dependency}%\n\n"
                    . "Immediate action is required!";

                // $projectDirectors = User::role('Project Director')->get();
                $projectDirectors = User::where('id', 1)->get();
                foreach ($projectDirectors as $pd) {
                    \Log::info('Message sent to Project Director: ' . $pd->name);
                    SendWhatsappJob::dispatch($pd->phone, $message);
                }

                $issue->update(['notified_project_director_at' => $now]);
            }

            \Log::info('Unresolved issues checked successfully.');
        } catch (\Exception $e) {
            \Log::error('Error checking unresolved issues: ' . $e->getMessage());
        }
    }
}
