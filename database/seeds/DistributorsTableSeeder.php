<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1, 10) as $item) {
            DB::table('distributors')->insert([
                'name' => $faker->name,
                'logo' => $faker->imageUrl('100', '100'),
                'location' => json_encode([
                    'latitude' => $faker->latitude,
                    'longitude' => $faker->longitude,
                    'address' => $faker->address,
                ]),
                'account_id' => $item,
            ]);
        }
    }
}
