<?php

use Illuminate\Database\Seeder;

class EnrollCfgTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_enroll_cfg')->insert([
            'enrl_begin_time' => '8月23日',
            'enrl_permission' => false
        ]);
    }
}
