<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return ApiResponse::sendResponse(200, 'Categories retrieved successfully', $categories);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return ApiResponse::sendResponse(201, 'Category created successfully', $category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $product = $category->products;
        return ApiResponse::sendResponse(200, 'Category retrieved successfully', $product);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        if (!$category) {
            return ApiResponse::sendResponse(404, 'Category not found', []);
        } else {
            $category->update([
                'name' => $request->name,
            ]);

            return ApiResponse::sendResponse(200, 'Category updated successfully', $category);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $deleted = $category->delete();
        if ($deleted) {
            return ApiResponse::sendResponse(200, 'Category deleted successfully', []);
        } else {
            return ApiResponse::sendResponse(500, 'Category not found', []);
        }
    }
}
