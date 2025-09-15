<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class TransactionRequest extends FormRequest
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
            'warehouse_id' => 'required|exists:warehouses,id',
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required_without:supplier_id|exists:customers,id',
            'supplier_id' => 'required_without:customer_id|exists:suppliers,id',
            'transaction_type' => 'required|in:in,out,return',
            'quantity' => 'required|integer|min:1',
        ];
    }
     public function failedValidation(Validator $validator){
        if($this->is('api/*')){
            $response= ApiResponse::sendResponse(422, 'fail to add transaction , please try again', $validator->errors()->all());
            throw new ValidationException($validator, $response);
        }
    }
}
