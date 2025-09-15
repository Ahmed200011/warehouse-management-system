<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return ApiResponse::sendResponse(200, 'Suppliers retrieved successfully', CustomerResource::collection($suppliers));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store( CustomerRequest $request)
    {
 $data = $request->validated();
        if ($data == false) {
            return ApiResponse::sendResponse(422,  'fail to add Supplier, please try again', $data->errors()->all());
        }else{
             $customer = Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
   
        ]);

        return ApiResponse::sendResponse(201, 'Supplier created successfully', new CustomerResource($customer));

        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Supplier $supplier)
    {
        $data = $request->validated();
        if ($data == false) {
            return ApiResponse::sendResponse(422,  'fail to update supplier, please try again', $data->errors()->all());
        } else {
            $supplier->update($request->validated());
            return ApiResponse::sendResponse(200, 'Supplier updated successfully', new CustomerResource($supplier));
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {

        $deleted = $supplier->delete();
        if ($deleted) {
            return ApiResponse::sendResponse(200, 'supplier deleted successfully', []);
        } else {
            return ApiResponse::sendResponse(500, 'supplier not found', []);
        }
    }
}
