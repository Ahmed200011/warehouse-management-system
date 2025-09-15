<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return ApiResponse::sendResponse(200, 'Customers retrieved successfully', CustomerResource::collection($customers));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $data = $request->validated();
        if ($data == false) {
            return ApiResponse::sendResponse(422,  'fail to add customer, please try again', $data->errors()->all());
        }else{
             $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
   
        ]);

        return ApiResponse::sendResponse(201, 'Customer created successfully', new CustomerResource($customer));

        }

          }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $data = $request->validated();
        if ($data == false) {
            return ApiResponse::sendResponse(422,  'fail to update customer, please try again', $data->errors()->all());
        } else {
            $customer->update($request->validated());
            return ApiResponse::sendResponse(200, 'Customer updated successfully', new CustomerResource($customer));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $deleted = $customer->delete();
        if ($deleted) {
            return ApiResponse::sendResponse(200, 'customer deleted successfully', []);
        } else {
            return ApiResponse::sendResponse(500, 'customer not found', []);
        }
    }
}
