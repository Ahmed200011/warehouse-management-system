<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ProductRequest extends FormRequest
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
            'code' => 'required|string|max:100|unique:products,code,' . $this->product?->id,
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'unit' => 'required|in:piece,box,kg,liter',
        ];
    }

     public function failedValidation(Validator $validator){
        if($this->is('api/*')){
            // dd($validator);
            $response= ApiResponse::sendResponse(422, 'fail to add product , please try again', $validator->errors()->all());
            throw new ValidationException($validator, $response);
        }
    }
}
