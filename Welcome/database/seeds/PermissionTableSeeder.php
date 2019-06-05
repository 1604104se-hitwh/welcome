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
            'pms_base_section' => 0,
            'pms_stu_info_section' => 0,
            'pms_post_section' => 0,
            'pms_shtl_section' => 0,
            'pms_enrl_section' => 0
        ]);
        DB::table('t_permission')->insert([
            'id' => 2,
            'pms_base_section' => 1,
            'pms_stu_info_section' => 1,
            'pms_post_section' => 1,
            'pms_shtl_section' => 1,
            'pms_enrl_section' => 1
        ]);
    }
}
