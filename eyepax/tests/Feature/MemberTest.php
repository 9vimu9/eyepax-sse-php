<?php

namespace Tests\Feature;

use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MemberTest extends TestCase
{
    use RefreshDatabase;

    public array $memberData = [
        'full_name' => 'Andrew Smith',
        'email' => 'andrew@expo.com',
        'telephone' => '0655147147',
        'joined_date' => '2014-04-05',
        'current_route' => 'Barns place',
        'comments' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    ];

    public string $indexUri = '/members';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_member_screen_can_be_rendered(): void
    {
        $response = $this->get($this->indexUri);

        $response->assertStatus(200);
    }

    public function test_new_member_can_add_to_the_team(): void
    {
        $response = $this->post('/members', $this->memberData);
        $response->assertRedirect($this->indexUri);
    }

    public function test_member_registration_requires_unique_email(): void
    {
        Member::factory()->create(['email' => 'other@email.com']);
        $response = $this->post('/members', $this->memberData);
        $response->assertValid('email');
        $response->assertRedirect($this->indexUri);
    }
//
    public function test_member_registration_requires_unique_telephone(): void
    {
        Member::factory()->create(['telephone' => '11']);
        $response = $this->post('/members', $this->memberData);
        $response->assertValid('telephone');
        $response->assertRedirect($this->indexUri);
    }

    public function test_member_registration_requires_full_name(): void
    {
        $response = $this->post('/members', $this->memberData);
        $response->assertValid('full_name');
        $response->assertRedirect($this->indexUri);
    }

    public function test_member_registration_requires_joined_date(): void
    {
        $response = $this->post('/members', $this->memberData);
        $response->assertValid('joined_date');
        $response->assertRedirect($this->indexUri);
    }

    public function test_member_registration_requires_formatted_joined_date(): void
    {
        $memberData = $this->memberData;
        $memberData['joined_date']='2022-12-11';
        $response = $this->post('/members', $memberData);
        $response->assertValid('joined_date');
        $response->assertRedirect($this->indexUri);
    }

    public function test_member_registration_requires_current_route(): void
    {
        $response = $this->post('/members', $this->memberData);
        $response->assertValid('current_route');
        $response->assertRedirect($this->indexUri);
    }

}
