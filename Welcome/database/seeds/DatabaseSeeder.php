<?php

use Illuminate\Database\Seeder;

require_once __DIR__.'/../../app/include.php';
use Jxlwqq\IdValidator\IdValidator;

class DatabaseSeeder extends Seeder
{
    private $idValidator;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(DormitoryTableSeeder::class);
        $this->call(EnrollCfgTableSeeder::class);
        $this->call(MajorTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(ShtlPortTableSeeder::class);

        $this->idValidator = new IdValidator(); 
        // $this->call(UsersTableSeeder::class);
        //生成一些 16040xxyy的学生信息
        for($i = 0; $i < 30; ++$i) {
            DB::table('t_student')->insert([
                'stu_status' => 'PREPARE',
                'stu_degree' => 'UG',
                'stu_num' => '16040'.sprintf("%02d", rand(0, 6)).sprintf("%02d", rand(0, 40)),
                'stu_name' => str_random(6),
                'stu_gen' => rand(0, 1),
                'stu_cid' => $this->idValidator->fakeId(true),
                'stu_eid' => str_random(14),
                //'class_id' => 4,
                'stu_dorm_str' => sprintf("%d", rand(1, 12)).'-'.sprintf("%1d", rand(1, 6)).sprintf("%02d", rand(1, 72)).'-'.sprintf("%1d", rand(0, 4))
            ]);
        }
        //生成一些 16020xxyy的学生信息
        for($i = 0; $i < 30; ++$i) {
            DB::table('t_student')->insert([
                'stu_status' => 'PREPARE',
                'stu_degree' => 'UG',
                'stu_num' => '16020'.sprintf("%02d", rand(0, 6)).sprintf("%02d", rand(0, 40)),
                'stu_name' => str_random(6),
                'stu_gen' => rand(0, 1),
                'stu_cid' => $this->idValidator->fakeId(true),
                'stu_eid' => str_random(14),
                'stu_dorm_str' => sprintf("%d", rand(1, 12)).'-'.sprintf("%1d", rand(1, 6)).sprintf("%02d", rand(1, 72)).'-'.sprintf("%1d", rand(0, 4))
            ]);
        }
        //生成一些 15040xxyy的学生信息（老生）
        for($i = 0; $i < 30; ++$i) {
            DB::table('t_student')->insert([
                'stu_status' => 'CURRENT',
                'stu_degree' => 'UG',
                'stu_num' => '15040'.sprintf("%02d", rand(0, 6)).sprintf("%02d", rand(0, 40)),
                'stu_name' => str_random(6),
                'stu_gen' => rand(0, 1),
                'stu_cid' => $this->idValidator->fakeId(true),
                'stu_eid' => str_random(14),
                //'class_id' => 4,
                'stu_dorm_str' => sprintf("%d", rand(1, 12)).'-'.sprintf("%1d", rand(1, 6)).sprintf("%02d", rand(1, 72)).'-'.sprintf("%1d", rand(0, 4))
            ]);
        }
    }
}
