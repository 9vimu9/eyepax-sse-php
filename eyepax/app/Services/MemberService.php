<?php

namespace App\Services;

use App\DTOs\MemberDTO;
use App\Repositories\member\MySqlMemberRepository;
use Illuminate\Http\Request;

class MemberService
{
    public function store(Request $request): MemberDTO
    {
        return (new MySqlMemberRepository())->store($request);
    }

    public function update(Request $request, $memberID): MemberDTO
    {
        return (new MySqlMemberRepository())->update($request,$memberID);
    }

    public function delete(int $memberID): bool
    {
        return (new MySqlMemberRepository())->delete($memberID);
    }

}
