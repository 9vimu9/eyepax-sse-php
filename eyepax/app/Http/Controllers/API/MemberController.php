<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use App\Services\MemberService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
     * @return JsonResponse
     */
    public function store(StoreMemberRequest $request): JsonResponse
    {
        try {
            $data = [
                'status' => 'success',
                'data' => [
                    'member' => $this->memberService->store($request)->toArray()
                ]
            ];
            return response()->json($data, ResponseAlias::HTTP_CREATED);

        } catch (Exception $exception) {
            $data = [
                'status' => 'error',
                'message' => $exception->getMessage()
            ];
            return response()->json($data, ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param Member $member
     * @return Response
     */
    public
    function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Member $member
     * @return Response
     */
    public
    function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMemberRequest $request
     * @param $memberID
     * @return JsonResponse
     */
    public
    function update(UpdateMemberRequest $request, $memberID): JsonResponse
    {
        try {
            $data = [
                'status' => 'success',
                'data' => [
                    'member' => $this->memberService->update($request, $memberID)->toArray()
                ]
            ];
            return response()->json($data, ResponseAlias::HTTP_OK);

        } catch (Exception $exception) {
            $data = [
                'status' => 'error',
                'message' => $exception->getMessage()
            ];
            return response()->json($data, ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $memberID
     * @return RedirectResponse
     */
    public
    function destroy($memberID): RedirectResponse
    {
        $this->memberService->delete($memberID);
        return redirect()->route("members.index");
    }
}
