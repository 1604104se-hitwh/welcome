<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_student')->insert([
            'stu_status' => 'PREPARE',
            'stu_degree' => 'UG',
            'stu_num' => '160400400',
            'stu_name' => '张三丰',
            'stu_gen' => true,
            'stu_cid' => "230123199010106583",
            'stu_eid' => '12345678901234',
            'class_id' => 4,
            'stu_dorm_str' => '12-666-6',
            'stu_fromSchool'=> '实验中学',
        ]);

        DB::table('t_student')->insert([
            'stu_status' => 'PREPARE',
            'stu_degree' => 'UG',
            'stu_num' => '160400401',
            'stu_name' => '四班甲',
            'stu_gen' => true,
            'stu_cid' => '13073119600207437X',
            'stu_eid' => '11145678901234',
            'class_id' => 4,
            'stu_dorm_str' => '6-170-4',
            'stu_fromSchool'=> '实验中学',
        ]);

        DB::table('t_student')->insert([
            'stu_status' => 'PREPARE',
            'stu_degree' => 'UG',
            'stu_num' => '160400402',
            'stu_name' => '四班乙',
            'stu_gen' => true,
            'stu_cid' => '451423199810285725',
            'stu_eid' => '11145678901234',
            'class_id' => 4,
            'stu_dorm_str' => '12-666-5',
            'stu_fromSchool'=> '实验中学',
        ]);

        DB::table('t_student')->insert([
            'stu_status' => 'PREPARE',
            'stu_degree' => 'UG',
            'stu_num' => '160400403',
            'stu_name' => '四班丙',
            'stu_gen' => true,
            'stu_cid' => '230123199603077335',
            'stu_eid' => '11145678901234',
            'class_id' => 4,
            'stu_dorm_str' => '12-666-4',
            'stu_fromSchool'=> '实验中学',
        ]);

        DB::table('t_student')->insert([
            'stu_status' => 'PREPARE',
            'stu_degree' => 'UG',
            'stu_num' => '160400404',
            'stu_name' => '四班丁',
            'stu_gen' => false,
            'stu_cid' => '230123199011274923',
            'stu_eid' => '11145678901234',
            'class_id' => 4,
            'stu_dorm_str' => '12-666-3',
            'stu_fromSchool'=> '实验中学',
        ]);

        DB::table('t_student')->insert([
            'stu_status' => 'PREPARE',
            'stu_degree' => 'UG',
            'stu_num' => '160400405',
            'stu_name' => '四班1',
            'stu_gen' => false,
            'stu_cid' => '230123199011274953',
            'stu_eid' => '11145678901234',
            'class_id' => 4,
            'stu_dorm_str' => '12-666-2',
            'stu_fromSchool'=> '实验中学',
        ]);

        DB::table('t_student')->insert([
            'stu_status' => 'PREPARE',
            'stu_degree' => 'UG',
            'stu_num' => '160400406',
            'stu_name' => '四班2',
            'stu_gen' => false,
            'stu_cid' => '230123199011274961',
            'stu_eid' => '11145678901234',
            'class_id' => 4,
            'stu_dorm_str' => '12-666-1',
            'stu_fromSchool'=> '实验中学',
        ]);
    }
}