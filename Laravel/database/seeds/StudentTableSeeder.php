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
            'stu_status' => 'PRE',
            'stu_degree' => 'UG',
            'stu_num' => '160400400',
            'stu_name' => '张三丰',
            'stu_gen' => true,
            'stu_cid' => '230123199811112222',
            'stu_eid' => '12345678901234',
            'class_id' => 4,
            'stu_dorm_str' => '12-666-6'
        ]);
    }
}
