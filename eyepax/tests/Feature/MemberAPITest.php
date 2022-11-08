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

    public array $memberDataStructure=[
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

    ];


    public function test_api_new_member_can_add_to_the_team(): void
    {
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $this->memberData);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure($this->memberDataStructure);
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
        $response->assertJsonValidationErrorFor("email", "data");
    }

    public function test_api_member_cant_register_without_unique_telephone(): void
    {
        $duplicateTelephone = "111111";
        Member::factory()->create(["telephone" => $duplicateTelephone]);
        $memberInput = $this->memberData;
        $memberInput["telephone"] = $duplicateTelephone;
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("telephone", "data");
    }

    public function test_api_member_cant_register_without_full_name(): void
    {
        $memberInput = $this->memberData;
        unset($memberInput["full_name"]);
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("full_name", "data");
    }

    public function test_api_member_cant_register_without_joined_date(): void
    {
        $memberInput = $this->memberData;
        unset($memberInput["joined_date"]);
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("joined_date", "data");
    }

    public function test_api_member_registration_requires_formatted_joined_date(): void
    {
        $memberInput = $this->memberData;
        $memberInput['joined_date'] = "not a proper date";
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("joined_date", "data");
    }

    public function test_api_member_cant_register_without_current_route(): void
    {
        $memberInput = $this->memberData;
        unset($memberInput["current_route"]);
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("current_route", "data");
    }

    public function test_api_member_cant_register_without_comments(): void
    {
        $memberInput = $this->memberData;
        unset($memberInput["comments"]);
        $response = $this->json(Request::METHOD_POST, $this->indexUri, $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("comments", "data");
    }


    public function test_api_can_update_member(): void
    {
        $member = Member::factory()->create($this->memberData);
        $response = $this->json(Request::METHOD_PUT, "$this->indexUri/$member->id", $this->memberData);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($this->memberDataStructure);
        $this->assertDatabaseHas($this->table, $this->memberData);

    }

    public function test_api_cant_update_member_with_duplicate_email(): void
    {
        $email1 = "member1@mail.com";
        $email2 = "member2@mail.com";
        Member::factory()->create(["email" => $email1]);
        $member2 = Member::factory()->create(["email" => $email2]);
        $memberInput = $this->memberData;
        $memberInput["email"] = $email1;
        $response = $this->json(Request::METHOD_PUT, "$this->indexUri/$member2->id", $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("email", "data");
    }

    public function test_api_cant_update_member_with_duplicate_telephone(): void
    {
        $telephone1 = "123456";
        $telephone2 = "1234567";
        Member::factory()->create(["telephone" => $telephone1]);
        $member2 = Member::factory()->create(["telephone" => $telephone2]);
        $memberInput = $this->memberData;
        $memberInput["telephone"] = $telephone1;
        $response = $this->json(Request::METHOD_PUT, "$this->indexUri/$member2->id", $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("telephone", "data");
    }

    public function test_api_member_cant_update_without_full_name(): void
    {
        $member = Member::factory()->create();
        $memberInput = $this->memberData;
        unset($memberInput["full_name"]);
        $response = $this->json(Request::METHOD_PUT, "$this->indexUri/$member->id", $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("full_name", "data");
    }

    public function test_api_member_cant_update_without_joined_date(): void
    {
        $member = Member::factory()->create();
        $memberInput = $this->memberData;
        unset($memberInput["joined_date"]);
        $response = $this->json(Request::METHOD_PUT, "$this->indexUri/$member->id", $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("joined_date", "data");
    }

    public function test_api_member_cant_update_without_current_route(): void
    {
        $member = Member::factory()->create();
        $memberInput = $this->memberData;
        unset($memberInput["current_route"]);
        $response = $this->json(Request::METHOD_PUT, "$this->indexUri/$member->id", $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("current_route", "data");
    }

    public function test_api_member_cant_update_without_comments(): void
    {
        $member = Member::factory()->create();
        $memberInput = $this->memberData;
        unset($memberInput["comments"]);
        $response = $this->json(Request::METHOD_PUT, "$this->indexUri/$member->id", $memberInput);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrorFor("comments", "data");
    }


    public function test_remove_member(): void
    {
        $member = Member::factory()->create();
        $response = $this->json(Request::METHOD_DELETE, "$this->indexUri/$member->id");
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing($this->table, $this->memberData);
    }

    public function test_returns_404_if_member_to_remove_has_invalid_id(): void
    {
        $member = Member::factory()->create();
        $memberID = $member->id + 1;
        $response = $this->json(Request::METHOD_DELETE, "$this->indexUri/$memberID");
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_get_member(): void
    {
        $member = Member::factory()->create();
        $response = $this->json(Request::METHOD_GET, "$this->indexUri/$member->id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($this->memberDataStructure);
    }

    public function test_returns_404_if_member_id_not_included(): void
    {
        $member = Member::factory()->create();
        $memberID = $member->id + 1;
        $response = $this->json(Request::METHOD_GET, "$this->indexUri/$memberID");
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_list_members()
    {
        Member::factory()->count(50)->create()->toArray();
        $response = $this->json(Request::METHOD_GET, $this->indexUri);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'members'
            ]

        ]);

    }


}
