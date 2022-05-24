<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $createdVehicleCategories = $this->createVehicleCategories();

        // Create 3 vehicles for each category
        foreach ($createdVehicleCategories as $category) {
            for ($i = 0; $i < 3; $i++) {
                Vehicle::factory()->create([
                    'vehicle_no' => $faker->regexify('[A-Z]{2}-[0-9]{4}'),
                    'category_id' => $category['id'],
                ]);
            }
        }
    }

    private function createVehicleCategories()
    {
        $titles = ['Dimo', '10 Feet', '20 Feet', '40 Feet'];

        $vehicleCategories = array_map(array($this, 'createVehicleCategory'), $titles);

        return $vehicleCategories;
    }

    private function createVehicleCategory($title)
    {
        $vehicleCategory =  VehicleCategory::factory()->create([
            'title' => $title,
            'slug' => Str::slug($title, '-')
        ]);

        return $vehicleCategory;
    }
}
