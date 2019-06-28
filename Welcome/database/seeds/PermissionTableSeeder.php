<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_permission')->insert([
            'id' => 1,
            'pms_name'=>'超级管理员',
            'pms_base_section' => 1,
            'pms_admin_section'=> 1,
            'pms_stu_info_section' => 2,
            'pms_post_section' => 2,
            'pms_shtl_section' => 2,
            'pms_enrl_section' => 2,
            'pms_reporting_section'=>1,
            'pms_help_verify' => 1,
        ]);
        DB::table('t_permission')->insert([
            'id' => 2,
            'pms_name'=>'招生办',
            'pms_base_section' => 1,
            'pms_admin_section'=> 0,
            'pms_stu_info_section' => 2,
            'pms_post_section' => 2,
            'pms_shtl_section' => 0,
            'pms_reporting_section'=> 0,
            'pms_help_verify' => 0,
            'pms_enrl_section' => 1
        ]);
        DB::table('t_permission')->insert([
            'id' => 3,
            'pms_name'=>'学工处',
            'pms_base_section' => 1,
            'pms_admin_section'=> 0,
            'pms_stu_info_section' => 0,
            'pms_post_section' => 2,
            'pms_shtl_section' => 2,
            'pms_reporting_section'=> 1,
            'pms_help_verify' => 1,
            'pms_enrl_section' => 2
        ]);

    }
}
