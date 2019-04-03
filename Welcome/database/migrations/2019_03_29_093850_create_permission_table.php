<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('pms_base_section')->default(0);
            $table->smallInteger('pms_stu_info_section')->default(0);
            $table->smallInteger('pms_post_section')->default(0);
            $table->smallInteger('pms_svy_section')->default(0);
            $table->smallInteger('pms_shtl_section')->default(0);
            $table->smallInteger('pms_enrl_section')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_permission');
    }
}