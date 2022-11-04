<?php

namespace App\Services;

use App\Models\Member;

class MemberService
{
    public function store($request): void
    {
        Member::create([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
            'joined_date' => $request->get('joined_date'),
            'current_route' => $request->get('current_route'),
            'comments' => $request->get('comments'),
        ]);


    }

    public function update($request, $memberID): void
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

    public function delete($memberID): void
    {
        Member::find($memberID)->delete();

    }

}
