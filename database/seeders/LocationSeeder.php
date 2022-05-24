<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = ['Biyagama', 'Katunayake Airport', 'Colombo Fort', 'Asialine - Middeniya', 'Countourline - Pallekele', 'Expo Lanka - Peliyagoda', 'Mamadala - Matara', 'Nirmana - Katunayake', 'Shadowline - Katunayake', 'Sleekline - Nittambuwa'];

        foreach ($locations as $location) {
            Location::factory()->create([
                'name' => $location,
                'slug' => Str::slug($location, '-')
            ]);
        }
    }
}
