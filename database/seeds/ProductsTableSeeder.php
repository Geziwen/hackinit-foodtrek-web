<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1, 20) as $item) {
            DB::table('products')->insert([
                'user_id' => random_int(1, 5),
                'harvested_at' => $faker->dateTime(),
                'type_id' => random_int(1, 10),
            ]);
        }
    }
}
