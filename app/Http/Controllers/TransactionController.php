<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionsResource;
use App\Models\ProductWarehouse;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Transactions = Transaction::with(['warehouse', 'product', 'customer', 'supplier'])->get();
        if ($Transactions->isEmpty()) {
            return ApiResponse::sendResponse(200, 'No transactions found', []);
        }
        return ApiResponse::sendResponse(200, 'Transactions retrieved successfully', TransactionsResource::collection($Transactions));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {

        $data = $request->validated();
        // dd($data);

        return DB::transaction(function () use ($data) {
            // في حالة إضافة كمية (in أو return)
            if (in_array($data['transaction_type'], ['in', 'return'])) {

                $productWarehouse = ProductWarehouse::firstOrCreate([
                    'warehouse_id' => $data['warehouse_id'],
                    'product_id' => $data['product_id'],
                ]);
                $productWarehouse->increment('quantity', $data['quantity']);
                // في حالة سحب كمية (out)
            } elseif ($data['transaction_type'] === 'out') {
                $productWarehouse = ProductWarehouse::where('warehouse_id', $data['warehouse_id'])
                    ->where('product_id', $data['product_id'])
                    ->first();


                if (!$productWarehouse || $productWarehouse->quantity < $data['quantity']) {

                    return ApiResponse::sendResponse(400, 'Insufficient stock for this transaction', []);
                }


                $productWarehouse->decrement('quantity', $data['quantity']);
            } else {
                return ApiResponse::sendResponse(400, 'Invalid transaction type', []);
            }


            $transaction = Transaction::create([
                'warehouse_id' => $data['warehouse_id'],
                'product_id' => $data['product_id'],
                'customer_id' => $data['customer_id'] ?? null,
                'supplier_id' => $data['supplier_id'] ?? null,
                'transaction_type' => $data['transaction_type'],
                'quantity' => $data['quantity'],
            ]);


            return ApiResponse::sendResponse(201, 'Transaction created successfully', new TransactionsResource($transaction));
        });
    }


    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
