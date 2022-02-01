<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Responses\StoreTransactionResponse;
use Symfony\Component\HttpFoundation\Response;


class StoreTransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|integer|exists:customers,id',
            'real_amount' => 'required|numeric',
        ];
    }

    protected function failedValidation(Validator $validator) {
        
        throw new HttpResponseException(
            response()->json(
                new StoreTransactionResponse(
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    $validator->errors()->messages(),
                    Response::$statusTexts[Response::HTTP_UNPROCESSABLE_ENTITY]
                ), 
                Response::HTTP_UNPROCESSABLE_ENTITY
            )
        );

    }

}
