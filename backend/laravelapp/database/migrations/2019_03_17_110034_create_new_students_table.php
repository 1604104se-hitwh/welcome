<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_new_stu_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("stu_id")->comment("学号");
            $table->string("exam_id")->comment("考号");
            $table->string("name")->comment("姓名");
            $table->string("gender")->comment("性别");
            $table->string("card_id")->comment("身份证号");
            $table->string("dormitory")->comment("宿舍");
            $table->boolean("checked")->comment("是否报到");
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
        Schema::dropIfExists('tbl_new_stu_info');
    }
}
