<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
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
            DB::table('transactions')->insert(array(
                'product_id' => $item,
                'sender_id' => App\Product::find($item)->producer->id,
                'receiver_id' => ($cr = random_int(1, 10)),
                'confirmed_at' => ($ct = $faker->dateTime),
                'received_at' => ($ct->add(new DateInterval('PT3600S'))),
            ));
            foreach(range(1, 5) as $j) {
                DB::table('transactions')->insert([
                    'product_id' => $item,
                    'sender_id' => $cr,
                    'receiver_id' => ($cr = random_int(1, 10)),
                    'confirmed_at' => ($ct->add(new DateInterval('PT1800S'))),
                    'received_at' => ($ct->add(new DateInterval('PT3600S'))),
                ]);
            }
        }
    }
}
