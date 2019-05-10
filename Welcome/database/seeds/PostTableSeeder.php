<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $items = [
            [
                'post_timestamp' => '2019-04-12 00:00:00',
                'post_title' => '测试通知1',
                'post_content' => '通知内容1',
                //'post_send_to' => 
            ],
            [
                'post_timestamp' => '2019-04-12 00:00:00',
                'post_title' => '测试通知2',
                'post_content' => '通知内容2',
                //'post_send_to' => 
            ],
            [
                'post_timestamp' => '2019-04-30 00:00:00',
                'post_title' => '关于5.1劳动节假期延长的通知',
                'post_content' => '祝大家劳动节快乐！',
                //'post_send_to' => 
            ]
        ];

        foreach ($items as $item) {
            // App\Models\Post::updateOrCreate([], $item);
        }
        
        DB::table('t_post')->insert([
            'post_timestamp' => '2019-04-12 00:00:00',
            'post_title' => '测试通知1',
            'post_content' => '通知内容1',
            //'post_send_to' => 
        ]);
        DB::table('t_post')->insert([
            'post_timestamp' => '2019-04-30 00:00:00',
            'post_title' => '关于5.1劳动节假期延长的通知',
            'post_content' => '祝大家劳动节快乐！',
            //'post_send_to' => 
        ]);
    }
}
