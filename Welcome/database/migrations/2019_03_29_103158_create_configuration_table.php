<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_configuration', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->boolean('conf_open_ctrl')->default(true);
            //$table->boolean('conf_svy_open_ctrl')->default(true);
            //$table->boolean('conf_svy_strict_ctrl')->default(true);
            $table->boolean('conf_shtl_open_ctrl')->default(true);
            $table->boolean('conf_enrl_open_ctrl')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_configuration');
    }
}
