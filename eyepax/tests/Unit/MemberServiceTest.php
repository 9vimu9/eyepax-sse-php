<?php

namespace Tests\Unit;

use App\DTOs\MemberDTO;
use App\Models\Member;
use App\Repositories\member\MemberRepositoryInterface;
use App\Services\MemberService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;

//use PHPUnit\Framework\TestCase;
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

        $expectedStoredMember = new MemberDTO(
            1,
            $this->memberData["full_name"],
            $this->memberData["email"],
            $this->memberData["telephone"],
            $this->memberData["joined_date"],
            $this->memberData["current_route"],
            $this->memberData["comments"]
        );
        $this->assertEquals($expectedStoredMember, $storedMember);
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

        $expectedUpdatedMember = new MemberDTO(
            $member->id,
            $member->full_name,
            $member->email,
            $member->telephone,
            $member->joined_date,
            $member->current_route,
            $member->comments
        );
        $this->assertEquals($expectedUpdatedMember, $updatedMember);
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
}
