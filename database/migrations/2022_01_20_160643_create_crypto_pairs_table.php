<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateCryptoPairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_pairs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80)->nullable()->unique('name_2');
            $table->string('image', 50)->nullable();
            $table->string('symbol', 30)->nullable()->unique('symbol');
            $table->tinyInteger('status')->default(0)->comment('Disable : 0, Enable : 1');
            $table->timestamps();
        });
        Artisan::call('db:seed', array('--class' => 'CryptoPairsTableSeeder'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crypto_pairs');
    }
}
