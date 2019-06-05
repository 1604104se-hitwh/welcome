<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSvyItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('t_svy_item', function (Blueprint $table) {
//            $table->engine = 'InnoDB';
//            $table->charset = 'utf8';
//            $table->collation = 'utf8_unicode_ci';
//            $table->increments('id');
//            $table->integer('svy_id')->unsigned();
//            $table->smallInteger('svy_type');
//            $table->text('svy_title');
//            $table->text('svy_content')->nullable();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_svy_item');
    }
}
