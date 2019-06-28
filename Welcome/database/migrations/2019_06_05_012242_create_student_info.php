<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_student_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id')->unique();
            $table->string('home_addr')->nullable();
            $table->string('phone_num',15)->nullable();
            $table->string('relate')->nullable();
            $table->string('nation',20)->default('汉族');
            $table->string('party')->default('共青团员');
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
        Schema::dropIfExists('student_info');
    }
}
