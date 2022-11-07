<?php

namespace Tests\Feature;

use App\Models\Member;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberAPITest extends TestCase
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

    public string $indexUri = 'api/members';
    public string $table = 'members';


    public function test_api_new_member_can_add_to_the_team(): void
    {
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $this->memberData);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'member' => [
                    'id',
                    'full_name',
                    'email',
                    'telephone',
                    'joined_date',
                    'current_route',
                    'comments',
                    'created_at'
                ]
            ]

        ]);
        $this->assertDatabaseHas($this->table, $this->memberData);

    }

    public function test_api_member_cant_register_without_unique_email(): void
    {
        $duplicateEmail = "email@mail.com";
        Member::factory()->create(["email" => $duplicateEmail]);
        $memberInput = $this->memberData;
        $memberInput["email"] = $duplicateEmail;
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("email");
    }

    public function test_api_member_cant_register_without_unique_telephone(): void
    {
        $duplicateTelephone = "111111";
        Member::factory()->create(["telephone" => $duplicateTelephone]);
        $memberInput = $this->memberData;
        $memberInput["telephone"] = $duplicateTelephone;
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("telephone");
    }

    public function test_api_member_cant_register_without_full_name(): void
    {
        $memberInput = $this->memberData;
        unset($memberInput["full_name"]);
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("full_name");
    }

    public function test_api_member_cant_register_without_joined_date(): void
    {
        $memberInput = $this->memberData;
        unset($memberInput["joined_date"]);
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("joined_date");
    }

    public function test_api_member_registration_requires_formatted_joined_date(): void
    {
        $memberInput = $this->memberData;
        $memberInput['joined_date'] = "not a proper date";
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("joined_date");
    }

    public function test_api_member_cant_register_without_current_route(): void
    {
        $memberInput = $this->memberData;
        unset($memberInput["current_route"]);
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("current_route");
    }

    public function test_api_member_cant_register_without_comments(): void
    {
        $memberInput = $this->memberData;
        unset($memberInput["comments"]);
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("comments");
    }



    public function test_can_update_member(): void
    {
        $member = Member::factory()->create();
        $response = $this->put("/members/$member->id", $member->toArray());
        $response->assertRedirect($this->indexUri);
    }

    public function test_api_can_update_member(): void
    {
        $member = Member::factory()->create($this->memberData);
        $response = $this->json(Request::METHOD_PUT, "$this->indexUri/$member->id", $this->memberDatap);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'member' => [
                    'id',
                    'full_name',
                    'email',
                    'telephone',
                    'joined_date',
                    'current_route',
                    'comments',
                    'created_at'
                ]
            ]

        ]);
        $this->assertDatabaseHas($this->table, $this->memberData);

    }

    public function test_cant_update_member_with_duplicate_email(): void
    {
        Member::factory()->create(["email" => "member1@mail.com"]);
        $member2 = Member::factory()->create(["email" => "member2@mail.com"]);
        $member2->email = "member1@mail.com";
        $response = $this->put("/members/$member2->id", $member2->toArray());
        $response->assertSessionHasErrors(['email']);
    }

    public function test_cant_update_member_with_duplicate_telephone(): void
    {
        $member1Telephone = "1234567";
        $member2Telephone = "12345678";
        Member::factory()->create(["telephone" => $member1Telephone]);
        $member2 = Member::factory()->create(["telephone" => $member2Telephone]);
        $member2->telephone = $member1Telephone;
        $response = $this->put("/members/$member2->id", $member2->toArray());
        $response->assertSessionHasErrors(['telephone']);
    }

    public function test_remove_member(): void
    {
        $member = Member::factory()->create();
        $response = $this->delete("/members/$member->id");
        $response->assertRedirect($this->indexUri);
    }

}
