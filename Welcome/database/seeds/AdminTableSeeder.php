<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_admin')->insert([
            'adm_name' => 'root',
            'adm_password' => bcrypt('1234'),
            'pms_id' => 2,
        ]);
        DB::table('t_admin')->insert([
            'adm_name' => 'tom',
            'adm_password' => bcrypt('1234'),
            'pms_id' => 1,
        ]);
    }
}
