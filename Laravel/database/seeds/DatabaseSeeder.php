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
        $this->idValidator = new IdValidator(); 
        // $this->call(UsersTableSeeder::class);
        for($i = 0; $i < 30; ++$i) {
            DB::table('t_student')->insert([
                'stu_status' => 'PRE',
                'stu_degree' => 'UG',
                'stu_num' => '16040'.sprintf("%02d", rand(0, 6)).sprintf("%02d", rand(0, 40)),
                'stu_name' => str_random(6),
                'stu_gen' => rand(0, 1),
                'stu_cid' => $this->idValidator->fakeId(true),
                'stu_eid' => str_random(14),
                'class_id' => 4,
                'stu_dorm_str' => sprintf("%d", rand(1, 12)).'-'.sprintf("%1d", rand(1, 6)).sprintf("%02d", rand(1, 72)).'-'.sprintf("%1d", rand(0, 4))
            ]);
        }
    }
}
