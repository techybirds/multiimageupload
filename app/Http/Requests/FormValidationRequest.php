<?php

namespace App\Http\Requests;

use App\Models\StatusCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class FormValidationRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required'
        ];
    }

    /**
     * API response to provide if any laravel validation error is triggered
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->api(
                StatusCode::LARAVEL_VALIDATION_ERROR,
                $validator->errors()->first(),
                null)
        );
    }
}
