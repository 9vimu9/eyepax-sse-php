<?php

namespace App\Services;

use App\DTOs\MemberDTO;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberService
{
    public function store(Request $request): MemberDTO
    {
        $member = (new Member())->newQuery()->create([
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

    public function update(Request $request, $memberID): MemberDTO
    {
        $member = tap((new Member())->newQuery()->findOrFail($memberID))->update([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
            'joined_date' => $request->get('joined_date'),
            'current_route' => $request->get('current_route'),
            'comments' => $request->get('comments'),
        ])->first();
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

    public function delete(int $memberID): bool
    {
        $result = (new Member())->newQuery()->findOrFail($memberID)->delete();
        return is_null($result) ? false : $result;
    }

}
