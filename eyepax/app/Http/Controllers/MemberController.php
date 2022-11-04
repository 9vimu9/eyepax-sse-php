<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMemberRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMemberRequest $request)
    {
        Member::create([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
            'joined_date' => $request->get('joined_date'),
            'current_route' => $request->get('current_route'),
            'comments' => $request->get('comments'),
        ]);

        return redirect()->route("members.index");

    }

    /**
     * Display the specified resource.
     *
     * @param Member $member
     * @return Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Member $member
     * @return Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMemberRequest $request
     * @param Member $member
     * @return RedirectResponse
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member->update([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
            'joined_date' => $request->get('joined_date'),
            'current_route' => $request->get('current_route'),
            'comments' => $request->get('comments'),
        ]);

        return redirect()->route("members.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Member $member
     * @return RedirectResponse
     */
    public function destroy(Member $member): RedirectResponse
    {
        $member->delete();
        return redirect()->route("members.index");
    }
}
