<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shift::firstOrNew(
            [
                'name' => '06.00 - 15:00',
                'time_start' => '06:00',
                'time_end' => '15:00',
            ]
        );

        Shift::firstOrNew(
            [
                'name' => '09.00 - 18:00',
                'time_start' => '09:00',
                'time_end' => '18:00',
            ],
        );

        Shift::firstOrNew(
            [
                'name' => '12.00 - 21:00',
                'time_start' => '12:00',
                'time_end' => '21:00',
            ],
        );

        Shift::firstOrNew(
            [
                'name' => '15.00 - 24:00',
                'time_start' => '15:00',
                'time_end' => '24:00',
            ],
        );

        Shift::firstOrNew(
            [
                'name' => '21.00 - 06:00',
                'time_start' => '21:00',
                'time_end' => '06:00',
            ],
        );
    }
}
