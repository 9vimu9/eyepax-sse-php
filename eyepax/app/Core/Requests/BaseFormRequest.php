<?php

namespace App\Core\Requests;

use App\Core\JSEND\JsendResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class BaseFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $response = JsendResponse::fail($validator->errors()->toArray());
        throw new HttpResponseException(response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY));
    }

}
