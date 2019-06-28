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
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('pms_name');
            $table->smallInteger('pms_base_section')->default(1);
            $table->smallInteger('pms_admin_section')->default(0);
            $table->smallInteger('pms_stu_info_section')->default(0);
            $table->smallInteger('pms_post_section')->default(0);
            $table->smallInteger('pms_shtl_section')->default(0);
            //$table->smallInteger('pms_svy_section')->default(0);
            $table->smallInteger('pms_enrl_section')->default(0);
            $table->smallInteger('pms_reporting_section')->default(0);
            $table->smallInteger('pms_help_verify')->default(0);
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
