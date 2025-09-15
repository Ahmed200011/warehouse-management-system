<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
class CustomerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $this->customer?->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ];
    }
    public function failedValidation(Validator $validator){
        if($this->is('api/*')){
            $response= ApiResponse::sendResponse(422, 'fail to add customer , please try again', $validator->errors()->all());
            throw new ValidationException($validator, $response);
        }
    }
}
