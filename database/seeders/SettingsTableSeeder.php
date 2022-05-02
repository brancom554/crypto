<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $settings = new Setting();
        $settings->field= 'dash_route';
        $settings->value= 'practice';
        $settings->save();

    }
}
