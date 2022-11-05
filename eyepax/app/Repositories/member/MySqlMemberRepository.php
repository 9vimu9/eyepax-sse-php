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
        $member = $this->builder->create([
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

    public function update(Request $request, int $memberID): MemberDTO
    {
        $member = tap($this->builder->findOrFail($memberID))->update([
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
        $result = $this->builder->findOrFail($memberID)->delete();
        return is_null($result) ? false : $result;
    }
}
