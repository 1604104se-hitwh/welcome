<?php

use Illuminate\Database\Seeder;

class MajorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //=======================汽车工程学院=======================
        DB::table('t_major')->insert([
            'major_num' => '012',
            'major_name' => '车辆工程',
            'dept_id' => 1
        ]);
        DB::table('t_major')->insert([
            'major_num' => '015',
            'major_name' => '交通工程',
            'dept_id' => 1
        ]);
        DB::table('t_major')->insert([
            'major_num' => '017',
            'major_name' => '能源与动力工程',
            'dept_id' => 1
        ]);
        //=======================信息与电气工程学院=======================
        DB::table('t_major')->insert([
            'major_num' => '020',
            'major_name' => '电子信息类',
            'dept_id' => 2
        ]);
        DB::table('t_major')->insert([
            'major_num' => '021',
            'major_name' => '自动化',
            'dept_id' => 2
        ]);
        DB::table('t_major')->insert([
            'major_num' => '022',
            'major_name' => '测控技术与仪器',
            'dept_id' => 2
        ]);
        DB::table('t_major')->insert([
            'major_num' => '023',
            'major_name' => '电气工程及其自动化',
            'dept_id' => 2
        ]);
        //=======================经济管理学院=======================
        DB::table('t_major')->insert([
            'major_num' => '030',
            'major_name' => '经济管理实验班',
            'dept_id' => 3
        ]);
        //=======================计算机科学与技术学院=======================
        DB::table('t_major')->insert([
            'major_num' => '040',
            'major_name' => '计算机类',
            'dept_id' => 4
        ]);
        DB::table('t_major')->insert([
            'major_num' => '111',
            'major_name' => '软件工程',
            'dept_id' => 4
        ]);
        //=======================语言文学学院=======================
        DB::table('t_major')->insert([
            'major_num' => '051',
            'major_name' => '英语',
            'dept_id' => 5
        ]);
        DB::table('t_major')->insert([
            'major_num' => '052',
            'major_name' => '朝鲜语',
            'dept_id' => 5
        ]);
        DB::table('t_major')->insert([
            'major_num' => '142',
            'major_name' => '汉语言文学',
            'dept_id' => 5
        ]);
        //=======================理学院=======================
        DB::table('t_major')->insert([
            'major_num' => '060',
            'major_name' => '数学类',
            'dept_id' => 6
        ]);
        DB::table('t_major')->insert([
            'major_num' => '102',
            'major_name' => '光电信息科学与工程',
            'dept_id' => 6
        ]);
        //=======================海洋科学与技术学院=======================
        DB::table('t_major')->insert([
            'major_num' => '070',
            'major_name' => '能源化学工程',
            'dept_id' => 7
        ]);
        DB::table('t_major')->insert([
            'major_num' => '071',
            'major_name' => '环境工程',
            'dept_id' => 7
        ]);
        DB::table('t_major')->insert([
            'major_num' => '072',
            'major_name' => '生物工程',
            'dept_id' => 7
        ]);
        //=======================材料科学与工程学院=======================
        DB::table('t_major')->insert([
            'major_num' => '081',
            'major_name' => '材料成型和控制工程',
            'dept_id' => 8
        ]);
        DB::table('t_major')->insert([
            'major_num' => '082',
            'major_name' => '焊接技术与工程',
            'dept_id' => 8
        ]);
        DB::table('t_major')->insert([
            'major_num' => '083',
            'major_name' => '材料科学与工程',
            'dept_id' => 8
        ]);
        //=======================船舶与海洋工程学院=======================
        DB::table('t_major')->insert([
            'major_num' => '131',
            'major_name' => '机械设计制造及其自动化',
            'dept_id' => 13
        ]);
        DB::table('t_major')->insert([
            'major_num' => '132',
            'major_name' => '船舶与海洋工程',
            'dept_id' => 13
        ]);
    }
}
