<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShtlRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_shtl_record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shtl_id')->unsigned();
            $table->integer('stu_id')->unsigned();
            $table->string('record_time', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_shtl_record');
    }
}
