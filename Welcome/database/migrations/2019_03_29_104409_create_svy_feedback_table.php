<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSvyFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('t_svy_feedback', function (Blueprint $table) {
//            $table->engine = 'InnoDB';
//            $table->charset = 'utf8';
//            $table->collation = 'utf8_unicode_ci';
//            $table->increments('id');
//            $table->integer('svy_id')->unsigned();
//            $table->text('fdbk_result')->nullable();
//            $table->smallInteger('fdbk_type')->nullable();
//            $table->timestamp('fdbk_timestamp')->nullable();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_svy_feedback');
    }
}
