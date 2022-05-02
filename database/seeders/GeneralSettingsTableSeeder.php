<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GeneralSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('general_settings')->where('id', '1')->update(['exchange_fee' => '3','practice_wallet' => 'USDT']);

    }
}
