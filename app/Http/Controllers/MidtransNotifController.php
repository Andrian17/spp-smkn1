<?php

namespace App\Http\Controllers;

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

        // UAS
        $uasPay = UasPayment::where('order_id', $notif->order_id)->first();
        $utsPay = UtsPayment::where('order_id', $notif->order_id)->first();

        if ($transaction == 'capture' || $transaction == 'settlement') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                if ($uasPay) {
                    $uasPay->status_pembayaran = "pending";
                    $uasPay->save();
                }
                if ($utsPay) {
                    $utsPay->status_pembayaran = "pending";
                    $utsPay->save();
                }
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                if ($uasPay) {
                    $uasPay->status_pembayaran = "success";
                    $uasPay->save();
                }
                if ($utsPay) {
                    $utsPay->status_pembayaran = "success";
                    $utsPay->save();
                }
            }
        } else if ($transaction == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                if ($uasPay) {
                    $uasPay->status_pembayaran = "failure";
                    $uasPay->save();
                }
                if ($utsPay) {
                    $utsPay->status_pembayaran = "failure";
                    $utsPay->save();
                }
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                if ($uasPay) {
                    $uasPay->status_pembayaran = "failure";
                    $uasPay->save();
                }
                if ($utsPay) {
                    $utsPay->status_pembayaran = "failure";
                    $utsPay->save();
                }
            }
        } else if ($transaction == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            if ($uasPay) {
                $uasPay->status_pembayaran = "failure";
                $uasPay->save();
            }
            if ($utsPay) {
                $utsPay->status_pembayaran = "failure";
                $utsPay->save();
            }
        } else if ($transaction == 'pending') {
            // TODO Set payment status in merchant's database to 'failure'
            if ($uasPay) {
                $uasPay->status_pembayaran = "failure";
                $uasPay->save();
            }
            if ($utsPay) {
                $utsPay->status_pembayaran = "failure";
                $utsPay->save();
            }
        } else if ($transaction == 'expire') {
            // TODO Set payment status in merchant's database to 'failure'
            if ($uasPay) {
                $uasPay->status_pembayaran = "failure";
                $uasPay->save();
            }
            if ($utsPay) {
                $utsPay->status_pembayaran = "failure";
                $utsPay->save();
            }
        }
        return;
    }

    public function updateSnapUTS(Request $request)
    {
        $request['order_id'] = 'spp-' . uniqid();
        DB::transaction(function () use ($request) {
            $midtrans = new CreateSnapToken($request);
            $snapToken = $midtrans->getSnapToken();

            // update
            UtsPayment::where('id', $request->id)->update(['order_id' => $request->order_id, 'snap_token' => $snapToken]);
        });
    }
    public function updateSnapUAS(Request $request)
    {
        $request['order_id'] = 'spp-' . uniqid();
        DB::transaction(function () use ($request) {
            $midtrans = new CreateSnapToken($request);
            $snapToken = $midtrans->getSnapToken();

            // update
            UasPayment::where('id', $request->id)->update(['order_id' => $request->order_id, 'snap_token' => $snapToken]);
        });
    }
}
