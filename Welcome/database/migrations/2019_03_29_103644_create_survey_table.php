<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('t_survey', function (Blueprint $table) {
//            $table->engine = 'InnoDB';
//            $table->charset = 'utf8';
//            $table->collation = 'utf8_unicode_ci';
//            $table->increments('id');
//            $table->string('svy_name', 100)->nullable();
//            $table->timestamp('svy_timestamp')->nullable();
//            $table->boolean('svy_real_name_flag')->default(true);
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_survey');
    }
}
