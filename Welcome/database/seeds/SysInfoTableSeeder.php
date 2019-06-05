<?php

use Illuminate\Database\Seeder;

class SysInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SysInfo::create([
            'school_info' => '暂无信息'
        ]);
    }
}
