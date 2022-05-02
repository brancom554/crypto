<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CryptoPairsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('crypto_pairs')->delete();

        \DB::table('crypto_pairs')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Bitcoin',
                'image' => 'BTC.png',
                'symbol' => 'BTC',
                'status' => 1,
                'created_at' => '2021-12-18 20:22:34',
                'updated_at' => '2021-12-18 20:22:34',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Tether',
                'image' => 'USDT.png',
                'symbol' => 'USDT',
                'status' => 1,
                'created_at' => '2021-12-18 20:26:30',
                'updated_at' => '2021-12-18 20:26:30',
            ),
        ));


    }
}
