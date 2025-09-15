<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class WarehouseRequest extends FormRequest
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
            'address' => 'required|string|max:500',
            'manager' => 'required|string|max:255',
        ];
    }
    public function failedValidation(Validator $validator){
        if($this->is('api/*')){
            $response= ApiResponse::sendResponse(422, 'fail to add warehouse , please try again', $validator->errors()->all());
            throw new ValidationException($validator, $response);
        }
    }
}
