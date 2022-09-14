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
                'name' => 'Shift 1',
                'time_start' => '06:00',
                'time_end' => '14:00',
            ]
        );

        Shift::firstOrNew(
            [
                'name' => 'Shift 2',
                'time_start' => '14:00',
                'time_end' => '22:00',
            ],
        );

        Shift::firstOrNew(
           [
                'name' => 'Shift 3',
                'time_start' => '22:00',
                'time_end' => '06:00',
            ],
        );
    }
}
