<?php

namespace App\Services;

use App\DTOs\MemberDTO;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;

class MemberService
{
    public function store(StoreMemberRequest $request): MemberDTO
    {
        $member = Member::create([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
            'joined_date' => $request->get('joined_date'),
            'current_route' => $request->get('current_route'),
            'comments' => $request->get('comments'),
        ]);

        return new MemberDTO(
            $member->id,
            $member->full_name,
            $member->email,
            $member->telephone,
            $member->joined_date,
            $member->current_route,
            $member->comments
        );


    }

    public function update(UpdateMemberRequest $request, $memberID): void
    {
        Member::find($memberID)->update([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
            'joined_date' => $request->get('joined_date'),
            'current_route' => $request->get('current_route'),
            'comments' => $request->get('comments'),
        ]);
    }

    public function delete(int $memberID): void
    {
        Member::find($memberID)->delete();

    }

}
