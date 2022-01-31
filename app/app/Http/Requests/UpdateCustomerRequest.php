<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Responses\StoreCustomerResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateCustomerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'gender' => 'string',
            'first_name' => 'string',
            'last_name' => 'string',
            'country' => 'string',
            'email' => 'email',
        ];
    }

    protected function failedValidation(Validator $validator) {
        
        throw new HttpResponseException(
            response()->json(
                new StoreCustomerResponse(
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    $validator->errors()->messages(),
                    Response::$statusTexts[Response::HTTP_UNPROCESSABLE_ENTITY]
                ), 
                Response::HTTP_UNPROCESSABLE_ENTITY
            )
        );

    }
}
