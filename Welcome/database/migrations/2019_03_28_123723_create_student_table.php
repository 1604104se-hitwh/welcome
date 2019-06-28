<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_student', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->enum('stu_status', ['PREPARE', 'ENROLL', 'CURRENT', 'GRADUATE', 'SUSPEND', 'COMPLETE', 'OTHER']);
            $table->enum('stu_degree', ['UG', 'M', 'D']);
            $table->char('stu_num', 10)->nullable()->unique();
            $table->string('stu_name', 15);
            $table->boolean('stu_gen')->default(false);
            $table->char('stu_cid', 18)->unique();
            $table->char('stu_eid', 14)->unique();
            //$table->integer('class_id')->unsigned();
            $table->string('stu_dorm_str', 10)->nullable()->unique();
            $table->string('stu_from_school', 10)->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_student');
    }
}
