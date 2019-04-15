<?php

use Illuminate\Database\Seeder;

class ShtlPortTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_shtl_port')->insert([
            'port_name' => '威海站',
            'port_info' => '威海火车/高铁南站',
        ]);
        DB::table('t_shtl_port')->insert([
            'port_name' => '威海北站',
            'port_info' => '威海火车/高铁北站',
        ]);
        DB::table('t_shtl_port')->insert([
            'port_name' => '威海港',
            'port_info' => '威海客货港口',
        ]);
        DB::table('t_shtl_port')->insert([
            'port_name' => '威海大水泊机场',
            'port_info' => '威海机场',
        ]);
        DB::table('t_shtl_port')->insert([
            'port_name' => '烟台蓬莱机场',
            'port_info' => '烟台机场',
        ]);
        DB::table('t_shtl_port')->insert([
            'port_name' => '青岛流亭机场',
            'port_info' => '青岛机场',
        ]);
    }
}
