<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startOfWeek = Carbon::now()->startOfWeek(); // Get the start of the current week

        $daysOfWeek = [
            'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'
        ];

        // Loop to create records for the first five days of the week
        foreach ($daysOfWeek as $day) {
            $date = $startOfWeek->copy(); // Copy the start of the week date
            $date->modify('next ' . $day); // Move to the next occurrence of the day

            // If the current date is in the future, go back a week
            if ($date->gt(Carbon::now())) {
                $date->subWeek();
            }

            // Insert a record into the 'days' table and get the ID
            $dayId = DB::table('days')->insertGetId([
                'date' => $date,
                'day_name' => $day, // Use the day name
                'available_places' => 50, // Default available places
                'created_at' => now(), // Set created_at timestamp
                'updated_at' => now(), // Set updated_at timestamp
            ]);

            // Insert places for each day
            for ($placeNumber = 1; $placeNumber <= 50; $placeNumber++) {
                DB::table('places')->insert([
                    'day_id' => $dayId,
                    'place_number' => $placeNumber,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
