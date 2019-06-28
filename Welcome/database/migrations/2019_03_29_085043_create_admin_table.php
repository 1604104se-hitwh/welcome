<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('t_admin', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('adm_name', 15)->unique();
            $table->string('adm_password', 64);
            $table->integer('pms_id')->unsigned();
            $table->integer('dept_id')->default(0);
        });

        /* 当创建数据表时，就马上执行填充命令，不需要手动artisan db:seed */
        // Artisan::call('db:seed', [
        //     '--class' => AdminTableSeeder::class
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('t_admin');
    }

}
