<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use App\Services\MemberService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class MemberController extends Controller
{
    private MemberService $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

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
    public function store(StoreMemberRequest $request): RedirectResponse
    {
        $this->memberService->store($request);
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
     * @param $memberID
     * @return RedirectResponse
     */
    public function update(UpdateMemberRequest $request, $memberID): RedirectResponse
    {
        $this->memberService->update($request, $memberID);
        return redirect()->route("members.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $memberID
     * @return RedirectResponse
     */
    public function destroy($memberID): RedirectResponse
    {
        $this->memberService->delete($memberID);
        return redirect()->route("members.index");
    }
}
