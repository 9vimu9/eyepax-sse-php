<?php

namespace App\Repositories\member;

use App\DTOs\MemberDTO;
use Illuminate\Http\Request;

interface MemberRepositoryInterface
{
    public function store(Request $request): MemberDTO;

    public function update(Request $request,int $memberID): MemberDTO;

    public function delete(int $memberID): bool;

}
