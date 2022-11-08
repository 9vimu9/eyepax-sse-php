<?php

namespace Tests\Unit;

use App\Models\Member;
use App\Services\MemberService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;


class MemberServiceTest extends TestCase
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

    /**
     * A basic unit test example.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function test_store(): void
    {
        $storeMemberRequest = new Request();
        $storeMemberRequest->merge($this->memberData);
        $storedMember = app()->make(MemberService::class)->store($storeMemberRequest);
        $this->assertObjectHasAttribute("id",$storedMember);
        $this->assertObjectHasAttribute("full_name",$storedMember);
        $this->assertObjectHasAttribute("email",$storedMember);
        $this->assertObjectHasAttribute("telephone",$storedMember);
        $this->assertObjectHasAttribute("joined_date",$storedMember);
        $this->assertObjectHasAttribute("current_route",$storedMember);
        $this->assertObjectHasAttribute("comments",$storedMember);
        $this->assertObjectHasAttribute("created_at",$storedMember);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_update(): void
    {
        $member = Member::factory()->create();
        $member->full_name = "name_updated";
        $updateMemberRequest = new Request();
        $updateMemberRequest->merge($member->toArray());
        $updatedMember = app()->make(MemberService::class)->update($updateMemberRequest, $member->id);

        $this->assertObjectHasAttribute("id",$updatedMember);
        $this->assertObjectHasAttribute("full_name",$updatedMember);
        $this->assertObjectHasAttribute("email",$updatedMember);
        $this->assertObjectHasAttribute("telephone",$updatedMember);
        $this->assertObjectHasAttribute("joined_date",$updatedMember);
        $this->assertObjectHasAttribute("current_route",$updatedMember);
        $this->assertObjectHasAttribute("comments",$updatedMember);
        $this->assertObjectHasAttribute("created_at",$updatedMember);
    }


    /**
     * @throws BindingResolutionException
     */
    public function test_delete(): void
    {
        $member = Member::factory()->create();
        $updatedMember = app()->make(MemberService::class)->delete($member->id);
        $this->assertTrue($updatedMember);
    }

    public function test_show(): void
    {
        $member = app()->make(MemberService::class)->show(Member::factory()->create()->id);

        $this->assertObjectHasAttribute("id",$member);
        $this->assertObjectHasAttribute("full_name",$member);
        $this->assertObjectHasAttribute("email",$member);
        $this->assertObjectHasAttribute("telephone",$member);
        $this->assertObjectHasAttribute("joined_date",$member);
        $this->assertObjectHasAttribute("current_route",$member);
        $this->assertObjectHasAttribute("comments",$member);
        $this->assertObjectHasAttribute("created_at",$member);
    }
}
