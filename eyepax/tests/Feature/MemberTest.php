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

    public function test_new_member_can_add_to_the_team()
    {
        $response = $this->post('/member', [
            'full_name' => 'Andrew Smith',
            'email' => 'andrew@expo.com',
            'telephone' => '0655147147',
            'joined_date' => '04-05-2014',
            'current_route' => 'Barns place',
            'comments' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        ]);

        $response->assertRedirect('/members');
    }
}
