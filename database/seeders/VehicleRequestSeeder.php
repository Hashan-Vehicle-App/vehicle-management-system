<?php

namespace Database\Seeders;

use App\Models\VehicleRequest;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VehicleRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Today requests
        for ($i = 1; $i <= 2; $i++) {
            VehicleRequest::factory()->create([
                'vehicle_id' => $i + 2,
                'pickup_location_id' => $i,
                'deliver_location_id' => $i + 1,
                'pickup_date' => Carbon::today()->toDateString(),
                'cost' => 1000 + 250 * $i
            ]);
        }

        // Tomorrow requests
        for ($i = 1; $i <= 2; $i++) {
            VehicleRequest::factory()->create([
                'vehicle_id' => $i * 2 + 2,
                'pickup_location_id' => $i + 1,
                'deliver_location_id' => $i + 2,
                'pickup_date' => Carbon::tomorrow()->toDateString(),
                'cost' => 1500 + 250 * $i
            ]);
        }

        // Yesterday requests
        for ($i = 1; $i <= 2; $i++) {
            VehicleRequest::factory()->create([
                'vehicle_id' => $i,
                'pickup_location_id' => $i + 2,
                'deliver_location_id' => $i + 3,
                'pickup_date' => Carbon::yesterday()->toDateString(),
                'cost' => 1500 + 250 * $i
            ]);
        }

        // Month before requests
        for ($i = 1; $i <= 2; $i++) {
            VehicleRequest::factory()->create([
                'vehicle_id' => $i + 3,
                'pickup_location_id' => $i + 3,
                'deliver_location_id' => $i + 4,
                'pickup_date' => Carbon::today()->subMonth(1)->toDateString(),
                'cost' => 750 + 200 * $i
            ]);

            // Month before + i day
            VehicleRequest::factory()->create([
                'vehicle_id' => $i + 7,
                'pickup_location_id' => $i + 3,
                'deliver_location_id' => $i + 4,
                'pickup_date' => Carbon::today()->subMonth(1)->addDays($i)->toDateString(),
                'cost' => 750 + 200 * $i
            ]);

            // Month before + (i * 2) day
            VehicleRequest::factory()->create([
                'vehicle_id' => $i + 4,
                'pickup_location_id' => $i + 3,
                'deliver_location_id' => $i + 4,
                'pickup_date' => Carbon::today()->subMonth(1)->addDays($i * 2)->toDateString(),
                'cost' => 750 + 200 * $i
            ]);

            // Month before - (i * 2) day
            VehicleRequest::factory()->create([
                'vehicle_id' => $i + 5,
                'pickup_location_id' => $i + 3,
                'deliver_location_id' => $i + 4,
                'pickup_date' => Carbon::today()->subMonth(1)->subDays($i * 2)->toDateString(),
                'cost' => 750 + 200 * $i
            ]);
        }
    }
}
