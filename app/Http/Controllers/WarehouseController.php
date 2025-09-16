<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\WarehouseRequest;
use App\Http\Resources\WarehouseResource;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::with('product','productWarehouses')->get();
        return ApiResponse::sendResponse(200, 'Warehouses retrieved successfully', WarehouseResource::collection($warehouses));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseRequest $request)
    {
        $data = $request->validated();
        if ($data == false) {
            return ApiResponse::sendResponse(422,  'fail to add warehouse, please try again', $data->errors()->all());
        } else {
            $warehouse = Warehouse::create($request->validated());
            return ApiResponse::sendResponse(201, 'Warehouse created successfully', new WarehouseResource($warehouse));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        return ApiResponse::sendResponse(200, 'Warehouse retrieved successfully', new WarehouseResource($warehouse));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WarehouseRequest $request, Warehouse $warehouse)
    {
        $data = $request->validated();
        if ($data == false) {
            return ApiResponse::sendResponse(422,  'fail to update warehouse, please try again', $data->errors()->all());
        } else {
            $warehouse->update($request->validated());
            return ApiResponse::sendResponse(200, 'Warehouse updated successfully', new WarehouseResource($warehouse));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        $deleted = $warehouse->delete();
        if ($deleted) {
            return ApiResponse::sendResponse(200, 'warehouse deleted successfully', []);
        } else {
            return ApiResponse::sendResponse(500, 'warehouse not found', []);
        }
    }
}
