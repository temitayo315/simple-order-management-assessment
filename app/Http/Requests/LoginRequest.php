<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required',
            'email' => 'required|string|email',
        ];
    }

    /**
     *  Send validation error response back to HTTP
    */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
 
        $response = response()->json([
            'status' => 'error',
            'message' => 'Invalid data send',
            'errors' => $errors->messages(),
        ], 422);
 
        throw new HttpResponseException($response);
    }
}
