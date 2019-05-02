<?php

namespace Tests\Feature;

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
        // test news
        $respose = $this->json('POST','/login',[
            'loginType' => 'new',
            'examId' => '12345678901234',
            'perId' => '230123199010106583',
        ]);
        //$respose->assertStatus(302);
        // test olds

        // test admins
        echo($this->post("/login",[
            'loginType' => 'admin',
            'userId' => 'root',
            'password' => '1234',
        ])->getOriginalContent());
        $respose = $this->json('POST','/login',[
            'loginType' => 'admin',
            'userId' => 'root',
            'password' => '1234',
        ]);
        $respose->assertStatus(302);
    }

    /**
     * logout test
     *
     * @return void
     */
    public function testLogoutTest(){
        $respose = $this->get('/logout');
        $respose->assertStatus(302);
    }
}
