<?php

namespace App\Http\Controllers\API;

use App\Core\JSEND\JsendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Services\MemberService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use RuntimeException;
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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $data = JsendResponse::success([
                'members' => $this->memberService->list()
            ]);
            return response()->json($data, ResponseAlias::HTTP_OK);

        } catch (Exception $exception) {
            $data = JsendResponse::error($exception->getMessage());
            return response()->json($data, ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);

        }
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
            $data = JsendResponse::success([
                'member' => $this->memberService->store($request)->toArray()
            ]);
            return response()->json($data, ResponseAlias::HTTP_CREATED);

        } catch (Exception $exception) {
            $data = JsendResponse::error($exception->getMessage());
            return response()->json($data, ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param $memberID
     * @return JsonResponse
     */
    public function show($memberID): JsonResponse
    {

        try {
            $data = JsendResponse::success([
                'member' => $this->memberService->show($memberID)->toArray()
            ]);
            return response()->json($data, ResponseAlias::HTTP_OK);

        } catch (ModelNotFoundException $exception) {
            $data = JsendResponse::error($exception->getMessage());
            return response()->json($data, ResponseAlias::HTTP_NOT_FOUND);

        } catch (Exception $exception) {
            $data = JsendResponse::error($exception->getMessage());
            return response()->json($data, ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);

        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMemberRequest $request
     * @param $memberID
     * @return JsonResponse
     */
    public function update(UpdateMemberRequest $request, $memberID): JsonResponse
    {
        try {
            $data = JsendResponse::success([
                'member' => $this->memberService->update($request, $memberID)->toArray()
            ]);
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
     * @return JsonResponse
     */
    public function destroy($memberID): JsonResponse
    {
        try {
            if (!$this->memberService->delete($memberID)) {
                throw new RuntimeException("user deletion failed");
            }
            $data = JsendResponse::success([]);
            return response()->json($data, ResponseAlias::HTTP_NO_CONTENT);

        } catch (ModelNotFoundException $exception) {
            $data = JsendResponse::error($exception->getMessage());
            return response()->json($data, ResponseAlias::HTTP_NOT_FOUND);

        } catch (Exception $exception) {
            $data = JsendResponse::error($exception->getMessage());
            return response()->json($data, ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);

        }

    }
}
