<?php

namespace App\Repositories\member;

use App\DTOs\MemberDTO;
use Illuminate\Contracts\Database\Eloquent\Builder as BuilderContract;
use Illuminate\Http\Request;

class MySqlMemberRepository implements MemberRepositoryInterface
{
    private BuilderContract $builder;

    public function __construct(BuilderContract $builder)
    {
        $this->builder = $builder;
    }


    public function store(Request $request): MemberDTO
    {
        return $this->builder->create([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
            'joined_date' => $request->get('joined_date'),
            'current_route' => $request->get('current_route'),
            'comments' => $request->get('comments'),
        ])->getData();

    }

    public function update(Request $request, int $memberID): MemberDTO
    {
        return tap($this->builder->findOrFail($memberID))->update([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
            'joined_date' => $request->get('joined_date'),
            'current_route' => $request->get('current_route'),
            'comments' => $request->get('comments'),
        ])->first()->getData();

    }

    public function delete(int $memberID): bool
    {
        $result = $this->builder->findOrFail($memberID)->delete();
        return is_null($result) ? false : $result;
    }

    public function list(): array
    {
        $members = [];
        foreach ($this->builder->get() as $member) {
            $members[] = $member->getData();
        }
        return $members;
    }

    public function show(int $memberID): MemberDTO
    {
        return $this->builder->findOrFail($memberID)->getData();
    }
}
