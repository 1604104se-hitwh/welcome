<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Students;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTest extends TestCase
{
    /**
     * login test.
     *
     * @return void
     */
    public function testLoginTest()
    {
        $get = Students::where([
            'stu_status'=>'PREPARE'
        ])->inRandomOrder(time())->first();
        // test news
        $this->json('POST','/login',[
            'loginType' => 'new',
            'examId' => $get->stu_eid,
            'perId' => $get->stu_cid,
        ])->assertSessionHas('Auth','new');
        // cross check
        $this->json('GET','/admin')->assertForbidden();
        $this->json('GET','/senior')->assertForbidden();
        $this->json('GET','/stu')->assertSuccessful();

        // test olds

        // test admins

        $adm_name = str_random(rand(0,15));
        $adm_psw = str_random(rand(0,15));

        Admin::insert([
            'adm_name' => $adm_name,
            'adm_password' => bcrypt($adm_psw),
            'pms_id' => 0,
        ]);

        $this->json('POST','/login',[
            'loginType' => 'admin',
            'userId' => $adm_name,
            'psw' => $adm_psw,
        ])->assertSessionHas('Auth','admin');

        // cross check
        $this->json('GET','/admin')->assertSuccessful();
        $this->json('GET','/senior')->assertForbidden();
        $this->json('GET','/stu')->assertForbidden();
    }

    /**
     * logout test
     *
     * @return void
     */
    public function testLogoutTest(){
        $this->json('POST','/login',[
            'loginType' => 'admin',
            'userId' => 'root',
            'psw' => '1234',
        ]);
        $this->json('GET','/admin')->assertSuccessful();
        $this->json('get','/logout')->assertSessionMissing('Auth');
        $this->json('GET','/admin')->assertRedirect();
    }
}
