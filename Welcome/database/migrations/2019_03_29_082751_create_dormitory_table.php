<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDormitoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_dormitory', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dorm_name', 10)->nullable();
            $table->double('dorm_position_x', 15, 10)->nullable();
            $table->double('dorm_position_y', 15, 10)->nullable();
            $table->text('dorm_desc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_dormitory');
    }
}
