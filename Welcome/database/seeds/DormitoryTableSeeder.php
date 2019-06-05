<?php

use Illuminate\Database\Seeder;

class DormitoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '1',
            'dorm_name' => '一公寓',
            'dorm_position_x' => 122.0816123486,
            'dorm_position_y' => 37.5321437804,
            'dorm_desc' => '一公寓',
        ]);
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '2',
            'dorm_name' => '二公寓',
            'dorm_position_x' => 122.0809578896,
            'dorm_position_y' => 37.5322926718,
            'dorm_desc' => '二公寓'
        ]);
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '3',
            'dorm_name' => '三公寓',
            'dorm_position_x' => 122.0812690258,
            'dorm_position_y' => 37.5327265824,
            'dorm_desc' => '三公寓'
        ]);
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '4',
            'dorm_name' => '四公寓',
            'dorm_position_x' => 122.0816123486,
            'dorm_position_y' => 37.5331647445,
            'dorm_desc' => '四公寓'
        ]);
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '5',
            'dorm_name' => '五公寓',
            'dorm_position_x' => 122.0818537474,
            'dorm_position_y' => 37.5316205309,
            'dorm_desc' => '五公寓'
        ]);
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '6',
            'dorm_name' => '六公寓',
            'dorm_position_x' => 122.0819985867,
            'dorm_position_y' => 37.5337475385,
            'dorm_desc' => '六公寓'
        ]);
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '7',
            'dorm_name' => '七公寓',
            'dorm_position_x' => 122.0798259974,
            'dorm_position_y' => 37.5328159166,
            'dorm_desc' => '七公寓'
        ]);
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '8',
            'dorm_name' => '八公寓',
            'dorm_position_x' => 122.0808452368,
            'dorm_position_y' => 37.5339729978,
            'dorm_desc' => '八公寓'
        ]);
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '9',
            'dorm_name' => '九公寓',
            'dorm_position_x' => 122.0811510086,
            'dorm_position_y' => 37.5346238481,
            'dorm_desc' => '九公寓'
        ]);
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '10',
            'dorm_name' => '十公寓',
            'dorm_position_x' => 122.0803946257,
            'dorm_position_y' => 37.5349131130,
            'dorm_desc' => '十公寓'
        ]);
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '11',
            'dorm_name' => '十一公寓',
            'dorm_position_x' => 122.0795041323,
            'dorm_position_y' => 37.5352534233,
            'dorm_desc' => '十一公寓'
        ]);
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '12',
            'dorm_name' => '十二公寓',
            'dorm_position_x' => 122.0854747295,
            'dorm_position_y' => 37.5330924266,
            'dorm_desc' => '十二公寓'
        ]);
        DB::table('t_dormitory')->insert([
            'dorm_tag' => '留',
            'dorm_name' => '留学生公寓',
            'dorm_position_x' => 122.0861399174,
            'dorm_position_y' => 37.5341559171,
            'dorm_desc' => '留学生公寓'
        ]);
    }
}
