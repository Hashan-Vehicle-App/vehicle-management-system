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
        VehicleRequest::factory()->create([
            'vehicle_id' => 1,
            'pickup_location_id' => 1,
            'deliver_location_id' => 2,
            'pickup_date' => Carbon::today()->toDateString()
        ]);

        VehicleRequest::factory()->create([
            'vehicle_id' => 4,
            'pickup_location_id' => 2,
            'deliver_location_id' => 3,
            'pickup_date' => Carbon::today()->toDateString()
        ]);

        VehicleRequest::factory()->create([
            'vehicle_id' => 7,
            'pickup_location_id' => 3,
            'deliver_location_id' => 4,
            'pickup_date' => Carbon::today()->toDateString(), 'status' => 'approved'
        ]);

        VehicleRequest::factory()->create([
            'vehicle_id' => 12,
            'pickup_location_id' => 5,
            'deliver_location_id' => 6,
            'pickup_date' => Carbon::today()->toDateString(), 'status' => 'declined'
        ]);

        VehicleRequest::factory()->create([
            'vehicle_id' => 1,
            'pickup_location_id' => 4,
            'deliver_location_id' => 2,
            'pickup_date' => Carbon::today()->toDateString()
        ]);
    }
}
