<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'pending',
                'display_name' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'arrived',
                'display_name' => 'Arrived',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'rescheduled',
                'display_name' => 'Rescheduled',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        Status::insert($data);
        // DB::insert('Statuses')->insert($data);
    }
}
