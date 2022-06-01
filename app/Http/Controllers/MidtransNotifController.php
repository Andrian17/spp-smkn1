<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class MidtransNotifController extends Controller
{

    public function __construct()
    {
        // Config Midtrans

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('services.midtrans.server');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    public function notification(Request $request)
    {
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Notification OKOKOKOk',
        //     'data' => $request->all()
        // ]);
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        error_log("Order ID $notif->order_id: " . "transaction status = $transaction, fraud staus = $fraud");
        $payment = Payment::where('order_id', $notif->order_id)->first();

        if ($transaction == 'capture' || $transaction == 'settlement') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                Payment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "pending"]);
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                Payment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "success"]);
            }
        } else if ($transaction == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                Payment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "failure"]);
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                Payment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "failure"]);
            }
        } else if ($transaction == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            Payment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "failure"]);
        } else if ($transaction == 'pending') {
            // TODO Set payment status in merchant's database to 'failure'
            Payment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "pendind"]);
        } else if ($transaction == 'expire') {
            // TODO Set payment status in merchant's database to 'failure'
            // $payment->setStatusExpired();
            Payment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "expired"]);
        }
        return;
    }

    public function coba()
    {
        return response()->json(['status' => 'success']);
    }
}
