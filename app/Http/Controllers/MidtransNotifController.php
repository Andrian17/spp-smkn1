<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\UasPayment;
use App\Models\UtsPayment;
use App\Services\Midtrans\CreateSnapToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        error_log("Order ID $notif->order_id: " . "transaction status = $transaction, fraud staus = $fraud");

        if ($transaction == 'capture' || $transaction == 'settlement') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                UasPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "pending"]);
                UtsPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "pending"]);
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                UasPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "success"]);
                UtsPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "success"]);
            }
        } else if ($transaction == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                UasPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "failure"]);
                UtsPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "failure"]);
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                UasPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "failure"]);
                UtsPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "failure"]);
            }
        } else if ($transaction == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            UasPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "failure"]);
            UtsPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "failure"]);
        } else if ($transaction == 'pending') {
            // TODO Set payment status in merchant's database to 'failure'
            UtsPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "pending"]);
            UasPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "pending"]);
        } else if ($transaction == 'expire') {
            // TODO Set payment status in merchant's database to 'failure'
            // $payment->setStatusExpired();
            UasPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "expired"]);
            UtsPayment::where('order_id', $notif->order_id)->update(['status_pembayaran' => "expired"]);
        }
        return;
    }

    public function updateSnap(Request $request)
    {
        // return response()->json([
        //     "data" => $request->all()
        // ], 200);
        // dd($request->all());
        DB::transaction(function () use ($request) {
            $midtrans = new CreateSnapToken($request);
            $snapToken = $midtrans->getSnapToken();

            // update
            UtsPayment::where('id', $request->id)->update(['snap_token' => $snapToken]);
        });
    }
}
