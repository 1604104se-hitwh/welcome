<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_department')->insert([
            'dept_name' => '车辆工程学院'
        ]);
        DB::table('t_department')->insert([
            'dept_name' => '信息与电气工程学院'
        ]);
        DB::table('t_department')->insert([
            'dept_name' => '经济管理学院'
        ]);
        DB::table('t_department')->insert([
            'dept_name' => '计算机科学与技术学院'
        ]);
        DB::table('t_department')->insert([
            'dept_name' => '语言文学学院'
        ]);
        DB::table('t_department')->insert([
            'dept_name' => '理学院'
        ]);
        DB::table('t_department')->insert([
            'dept_name' => '海洋科学与技术学院'
        ]);
        DB::table('t_department')->insert([
            'dept_name' => '材料科学与工程学院'
        ]);
        DB::table('t_department')->insert([
            'dept_name' => '船舶与海洋工程学院'
        ]);
    }
}
