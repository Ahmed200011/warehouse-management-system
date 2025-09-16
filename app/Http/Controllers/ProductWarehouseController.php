<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\ProductWarehouseResource;
use App\Models\ProductWarehouse;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ProductWarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productWarehouses = ProductWarehouse::with(['product', 'warehouse'])->get();
        // $warehouse=Warehouse::with('product')->get();

        return ApiResponse::sendResponse(200, 'Product Warehouses retrieved successfully', ProductWarehouseResource::collection($productWarehouses) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductWarehouse $productWarehouse)
    {
        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductWarehouse $productWarehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductWarehouse $productWarehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductWarehouse $productWarehouse)
    {
        //
    }
}
