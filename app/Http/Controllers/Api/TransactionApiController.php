<?php

// app/Http/Controllers/TransactionController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionApiController extends Controller
{
    // Membuat transaksi baru dan mengaitkannya dengan order
    public function createTransaction(Request $request)
    {
        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'transaction_id' => 'required|unique:transactions,transaction_id',
            'payment_status' => 'required|in:pending,success,failed,cancelled',
            'payment_method' => 'required|string',
            'payment_url' => 'nullable|url',
        ]);

        // Jika validasi gagal, kembalikan error
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        // Ambil data order berdasarkan order_id yang diberikan
        $order = Order::findOrFail($request->order_id);

        // Cek apakah order sudah memiliki transaksi
        if ($order->transaction) {
            return response()->json([
                'status' => 'error',
                'message' => 'This order already has a transaction.',
            ], 400);
        }

        // Membuat transaksi baru
        $transaction = Transaction::create([
            'order_id' => $order->id,
            'transaction_id' => $request->transaction_id,
            'payment_status' => $request->payment_status,
            'payment_method' => $request->payment_method,
            'payment_url' => $request->payment_url,
        ]);

        // Update status order menjadi `paid` jika pembayaran berhasil
        if ($request->payment_status === 'success') {
            $order->update(['status' => 'paid']);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction created successfully.',
            'transaction' => $transaction,
        ], 201);
    }

    // Mendapatkan status transaksi berdasarkan order_id
    public function getTransactionStatus($orderId)
    {
        // Ambil data order berdasarkan order_id
        $order = Order::findOrFail($orderId);

        // Ambil transaksi yang terkait dengan order ini
        $transaction = $order->transaction;

        // Jika transaksi tidak ada
        if (!$transaction) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction not found for this order.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'transaction_status' => $transaction->payment_status,
            'transaction' => $transaction,
        ]);
    }

    // Menangani callback dari layanan pembayaran (seperti Midtrans)
    public function paymentCallback(Request $request)
    {
        // Validasi data callback (sesuaikan dengan struktur yang dikirimkan oleh Midtrans atau gateway lain)
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|exists:transactions,transaction_id',
            'payment_status' => 'required|in:pending,success,failed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        // Ambil transaksi berdasarkan transaction_id
        $transaction = Transaction::where('transaction_id', $request->transaction_id)->first();

        // Update status pembayaran
        $transaction->update(['payment_status' => $request->payment_status]);

        // Jika transaksi sukses, ubah status order menjadi `paid`
        if ($request->payment_status === 'success') {
            $transaction->order->update(['status' => 'paid']);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Payment status updated successfully.',
            'transaction' => $transaction,
        ]);
    }
}
