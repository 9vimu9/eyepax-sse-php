<?php

namespace App\Services;

use App\DTOs\MemberDTO;
use App\Repositories\member\MemberRepositoryInterface;
use Illuminate\Http\Request;

class MemberService
{
    public MemberRepositoryInterface $memberRepository;

    public function __construct(MemberRepositoryInterface $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function list(): array
    {
        return $this->memberRepository->list();
    }

    public function store(Request $request): MemberDTO
    {
        return $this->memberRepository->store($request);
    }

    public function update(Request $request, $memberID): MemberDTO
    {
        return $this->memberRepository->update($request, $memberID);
    }

    public function delete(int $memberID): bool
    {
        return $this->memberRepository->delete($memberID);
    }

    public function show($memberID): MemberDTO
    {
        return $this->memberRepository->show($memberID);
    }

}
