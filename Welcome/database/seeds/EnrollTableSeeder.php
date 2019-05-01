<?php

use Illuminate\Database\Seeder;

class EnrollTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_enroll')->insert([
            'enrl_title' => '流程一',
            'enrl_info' => "",
            'enrl_location' => "",
            'enrl_rank' => 1
        ]);
        DB::table('t_enroll')->insert([
            'enrl_title' => '流程二',
            'enrl_info' => "",
            'enrl_location' => "",
            'enrl_rank' => 2
        ]);
        DB::table('t_enroll')->insert([
            'enrl_title' => '流程三',
            'enrl_info' => "",
            'enrl_location' => "",
            'enrl_rank' => 3
        ]);
        DB::table('t_enroll')->insert([
            'enrl_title' => '流程四',
            'enrl_info' => "",
            'enrl_location' => "",
            'enrl_rank' => 4
        ]);
    }
}
