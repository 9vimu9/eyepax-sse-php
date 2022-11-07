<?php

namespace App\Http\Requests;


use App\Core\Requests\BaseFormRequest;

class StoreMemberRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'full_name' => 'required',
            'joined_date' => 'required|date',
            'current_route' => 'required',
            'comments' => 'required',
            'email' => 'required|email|unique:members',
            'telephone' => 'required|unique:members',
        ];
    }
}
