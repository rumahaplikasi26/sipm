<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Scope;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Activity::factory(10)->create();
        // Activity::create(
        //     [
        //         'date' => date('Y-m-d'),
        //         'title' => fake('id_ID')->sentence(3),
        //         'slug' => fake('id_ID')->slug(),
        //         'group_id' => 1,
        //         'position_id' => 1,
        //         'total_estimate' => 3,
        //         'type_estimate' => 'day',
        //         'forecast_date' =>  Carbon::now()->addDays(2),
        //         'plan_date' => Carbon::now()->addDays(3),
        //         'actual_date' => Carbon::now()->addDays(5),
        //         'supervisor_id' => 3,
        //         'description' => fake('id_ID')->text(100),
        //         'status_id' => 1
        //     ]
        // );


        DB::statement("insert  into `activities`(`id`,`date`,`title`,`slug`,`group_id`,`position_id`,`total_estimate`,`type_estimate`,`forecast_date`,`plan_date`,`actual_date`,`supervisor_id`,`description`,`progress`,`status_id`,`created_at`,`updated_at`) values
            (1,'2024-12-07','7 Desember 2024 IT A3','tanggal-7-desember-2024-it-a3',1,2,12,'day','2025-01-19','2025-01-10',NULL,7,NULL,0,3,'2025-01-22 21:49:24','2025-01-22 21:49:24'),
            (2,'2025-01-14','14 Januari 2025 IT A3','tanggal-14-januari-2025',1,2,11,'day','2025-01-25','2025-01-25',NULL,7,NULL,0,3,'2025-01-22 21:50:40','2025-01-22 21:50:40'),
            (3,'2025-01-14','14 Januari 2025 IT B3','tanggal-14-januari-2025',2,2,8,'day','2025-01-22','2025-01-14',NULL,8,NULL,0,3,'2025-01-22 21:52:12','2025-01-22 21:52:12'),
            (4,'2024-12-07','7 Desember 2024 IT A4','tanggal-7-desember-2024-it-a4',3,2,45,'day','2025-01-15','2025-01-01',NULL,9,NULL,0,3,'2025-01-22 21:55:13','2025-01-22 21:55:13'),
            (5,'2025-01-10','10 Januaro 2024 IT C4','tanggal-10-januaro-2024-it-c4',4,2,5,'day','2025-01-15','2025-01-10',NULL,10,NULL,0,3,'2025-01-22 21:56:54','2025-01-22 21:56:54'),
            (6,'2024-11-20','20 November 2024 DH Corridor','tanggal-20-november-2024-dh-corridor',5,2,60,'day','2025-01-22','2025-01-01',NULL,11,NULL,0,3,'2025-01-22 21:58:23','2025-01-22 21:58:23'),
            (7,'2025-01-14','14 Januari 2025 DH5','14-januari-2025',6,2,5,'day','2025-01-19','2025-01-14',NULL,12,NULL,0,3,'2025-01-22 22:00:52','2025-01-22 22:00:52'),
            (8,'2025-01-14','14 Januari 2025 DH6','tanggal-14-januari-2025-dh6',7,2,5,'day','2025-01-19','2025-01-14',NULL,12,NULL,0,3,'2025-01-22 22:02:14','2025-01-22 22:02:14'),
            (9,'2025-01-02','2 Januari 2025 DH6','2-januari-2025-dh6',7,2,14,'day','2025-01-16','2025-01-02',NULL,9,NULL,0,3,'2025-01-22 22:05:57','2025-01-22 22:05:57'),
            (10,'2025-01-17','17 Januari 2025 DH7','17-januari-2025-dh7',8,2,5,'day','2025-01-22','2025-01-17',NULL,12,NULL,0,3,'2025-01-22 22:07:19','2025-01-22 22:07:19'),
            (11,'2025-01-17','17 Januari 2025 DH8','17-januari-2025-dh8',9,2,5,'day','2025-01-22','2025-01-17',NULL,14,NULL,0,3,'2025-01-22 22:08:07','2025-01-22 22:08:07');
        ");

        DB::statement("insert  into `activity_details`(`id`,`activity_id`,`scope_id`,`progress`,`created_at`,`updated_at`) values
            (1,1,1,0,'2025-01-22 21:49:24','2025-01-22 21:49:24'),
            (2,2,2,0,'2025-01-22 21:50:40','2025-01-22 21:50:40'),
            (3,3,1,0,'2025-01-22 21:52:12','2025-01-22 21:52:12'),
            (4,4,1,0,'2025-01-22 21:55:13','2025-01-22 21:55:13'),
            (5,5,1,0,'2025-01-22 21:56:54','2025-01-22 21:56:54'),
            (6,6,1,0,'2025-01-22 21:58:23','2025-01-22 21:58:23'),
            (7,7,1,0,'2025-01-22 22:00:52','2025-01-22 22:00:52'),
            (8,8,1,0,'2025-01-22 22:02:14','2025-01-22 22:02:14'),
            (9,9,3,0,'2025-01-22 22:05:58','2025-01-22 22:05:58'),
            (10,10,1,0,'2025-01-22 22:07:19','2025-01-22 22:07:19'),
            (11,11,1,0,'2025-01-22 22:08:07','2025-01-22 22:08:07');
        ");
    }
}
