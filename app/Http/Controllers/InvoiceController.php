<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoice = invoice::with('items.product', 'customer', 'supplier', 'items.warehouse')->get();
        return ApiResponse::sendResponse(200, 'Invoices retrieved successfully', $invoice);
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
    public function show(invoice $invoice)
    {
        return ApiResponse::sendResponse(200, 'Invoice retrieved successfully', $invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invoice $invoice)
    {
        //
    }
}
