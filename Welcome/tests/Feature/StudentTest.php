<?php

namespace Tests\Feature;

use App\Models\Students;
use Tests\TestCase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStudentIndex()
    {
        $res_obj = Students::inRandomOrder()->first();

        $response = $this->withSession([
            'Auth' => 'new',
            "id" => $res_obj->id,
            "stu_status" => $res_obj->stu_status,
            "stu_num" => $res_obj->stu_num,
            "stu_name" => $res_obj->stu_name,
            "stu_gen" => $res_obj->stu_gen,
            "stu_cid" => $res_obj->stu_cid,
            "stu_eid" => $res_obj->stu_eid,
            //"class_id" => $res_obj->class_id,
            "stu_dorm_str" => $res_obj->stu_dorm_str,
            "stu_from_school" => $res_obj->stu_from_school,
        ])->get('/stu');
        $response->assertSuccessful();
        // assert if index has
        $response->assertSeeText('哈尔滨工业大学');
        // assert index has stu id , name , school , gender
        $response->assertSeeText($res_obj->stu_num);
        $response->assertSeeText($res_obj->stu_name);
        $response->assertSeeText($res_obj->stu_gen?'男':'女');

    }

    public function testPostindex(){
        $res_obj = Students::inRandomOrder()->first();

        $response = $this->withSession([
            'Auth' => 'new',
            "id" => $res_obj->id,
            "stu_status" => $res_obj->stu_status,
            "stu_num" => $res_obj->stu_num,
            "stu_name" => $res_obj->stu_name,
            "stu_gen" => $res_obj->stu_gen,
            "stu_cid" => $res_obj->stu_cid,
            "stu_eid" => $res_obj->stu_eid,
            //"class_id" => $res_obj->class_id,
            "stu_dorm_str" => $res_obj->stu_dorm_str,
            "stu_from_school" => $res_obj->stu_from_school,
        ])->get('/stu/posts');
        $response->assertSuccessful();
        // assert if index has
        $response->assertSeeText('哈尔滨工业大学');
        // assert index has stu id , name , school , gender

    }
}
