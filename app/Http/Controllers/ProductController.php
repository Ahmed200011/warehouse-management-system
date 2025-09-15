<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return ApiResponse::sendResponse(200, 'Products retrieved successfully', ProductResource::collection($products));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // dd($request);

        $data = $request->validated();
        if ($data == false) {
            return ApiResponse::sendResponse(422,  'fail to add product, please try again', $data->errors()->all());
        } else {
            $product = Product::create([
                'name' => $request->name,
                'code' => $request->code,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'unit' => $request->unit,
            ]);
            return ApiResponse::sendResponse(201, 'Product created successfully', new ProductResource($product));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        if ($data == false) {
            return ApiResponse::sendResponse(422,  'fail to update product, please try again', $data->errors()->all());
        } else {
            $product->update([
                'name' => $request->name,
                'code' => $request->code,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'unit' => $request->unit,
            ]);
            return ApiResponse::sendResponse(200, 'Product updated successfully', new ProductResource($product));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $deleted = $product->delete();
        if ($deleted) {
            return ApiResponse::sendResponse(200, 'product deleted successfully', []);
        } else {
            return ApiResponse::sendResponse(500, 'product not found', []);
        }
    }
}
