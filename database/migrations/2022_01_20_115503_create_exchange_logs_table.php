<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('from');
            $table->string('to');
            $table->decimal('amount_from', 18, 8)->default(0);
            $table->decimal('price_was', 18, 8)->default(0);
            $table->tinyInteger('type')->comment('Running : 0 Complete : 1');
            $table->tinyInteger('status')->default(0)->comment('Running : 0 Complete : 1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_logs');
    }
}
