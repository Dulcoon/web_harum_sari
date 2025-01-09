<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Transaction;
use PHPUnit\Framework\Constraint\IsEmpty;

class MidtransController extends Controller
{
    public function createTransaction(Request $request)
    {

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi dari request
        $orderId = $request->order_id;
        $grossAmount = $request->gross_amount;
        $items = $request->items; 
        $customerDetails = $request->customer; 
        $userId = $request->user_id;
    
        Transaction::create([
            'user_id' => $userId,
            'order_id' => $orderId,
            'payment_status' => 'pending', 
            'gross_amount' => $grossAmount,
            'items' => json_encode($items), 
            'customer_first_name' => $customerDetails['first_name'], 
            'customer_last_name' => $customerDetails['last_name'], 
            'customer_email' => $customerDetails['email'], 
            'customer_phone' => $customerDetails['phone'], 
        ]);
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => $items,
            'customer_details' => $customerDetails,
        ];


        try {
            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function success()
    {
        return view('thank-you');
    }

    public function handleNotification(Request $request)
    {
        $notif = $request->all(); 

        $orderId = $notif['order_id'];
        $transaction = Transaction::where('order_id', $orderId)->first(); // Cari transaksi berdasarkan order_id
        
        if (!$transaction) {
            $response = response()->json(['error' => 'Transaction not found'], 404);
            \Log::info('Response:', ['status' => 404, 'message' => 'Transaction not found']);
            return $response;
        }
    
        // Cek status transaksi
        $transactionStatus = $notif['transaction_status'];
        $fraudStatus = $notif['fraud_status'];
    
        switch ($transactionStatus) {
            case 'capture':
                if ($fraudStatus == 'challenge') {
                    $transaction->payment_status = 'failed';
                } else {
                    $transaction->payment_status = 'completed';
                }
                break;
            case 'settlement':
                $transaction->payment_status = 'completed';
                break;
            case 'pending':
                $transaction->payment_status = 'pending';
                break;
            case 'deny':
                $transaction->payment_status = 'failed';
                break;
            case 'expired':
                $transaction->payment_status = 'failed';
                break;
            case 'cancel':
                $transaction->payment_status = 'failed';
                break;
            default:
                $transaction->payment_status = 'failed';
                break;
        }
    
        $transaction->save();
    
        $response = response()->json(['status' => 'success']);
        return $response;
    }

    public function getTransactionsByUserId($userId)
    {
        $transactions = Transaction::where('user_id', $userId)->get();

        if ($transactions->isEmpty()) {
            return response()->json(['message' => 'No transactions found for this user'], 404);
        }

        return response()->json($transactions, 200);
    }

}
