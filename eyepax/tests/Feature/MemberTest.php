<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MemberTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_member_screen_can_be_rendered()
    {
        $response = $this->get('/members');

        $response->assertStatus(200);
    }

//    public function test_new_member_can_add()
//    {
//        $response = $this->post('')
//
//        $response->assertStatus(200);
//    }
}
