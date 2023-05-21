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
                    $uasPay->status_pembayaran = "failed";
                    $uasPay->save();
                }
                if ($utsPay) {
                    $utsPay->status_pembayaran = "failed";
                    $utsPay->save();
                }
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                if ($uasPay) {
                    $uasPay->status_pembayaran = "failed";
                    $uasPay->save();
                }
                if ($utsPay) {
                    $utsPay->status_pembayaran = "failed";
                    $utsPay->save();
                }
            }
        } else if ($transaction == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            if ($uasPay) {
                $uasPay->status_pembayaran = "failed";
                $uasPay->save();
            }
            if ($utsPay) {
                $utsPay->status_pembayaran = "failed";
                $utsPay->save();
            }
        } else if ($transaction == 'pending') {
            // TODO Set payment status in merchant's database to 'failure'
            if ($uasPay) {
                $uasPay->status_pembayaran = "failed";
                $uasPay->save();
            }
            if ($utsPay) {
                $utsPay->status_pembayaran = "failed";
                $utsPay->save();
            }
        } else if ($transaction == 'expire') {
            // TODO Set payment status in merchant's database to 'failure'
            if ($uasPay) {
                $uasPay->status_pembayaran = "failed";
                $uasPay->save();
            }
            if ($utsPay) {
                $utsPay->status_pembayaran = "failed";
                $utsPay->save();
            }
        }
        return response()->json('', 200, ['status' => 'success']);
    }

    public function updateSnap(Request $request)
    {
        $paymentType = $request->input("payment_type");
        $oldSnapToken = $request->input("old_snap_token");
        $result = $this->updateSnapToken($paymentType, $oldSnapToken);
        return response()->json([
            "message" => "snap token generated!",
            "result" => json_encode($result)
        ]);
    }

    public function updateSnapToken($paymentType, $oldSnapToken)
    {
        if ($paymentType === "UTS") {
            $utsPayment = UtsPayment::where("snap_token", $oldSnapToken)->first();
            $dataPayment = (object) $this->dataPayment($utsPayment);
            DB::transaction(function () use ($dataPayment) {
                $midtrans = new CreateSnapToken($dataPayment);
                $snapToken = $midtrans->getSnapToken();
                // update
                return $this->utsUpdateSnap($dataPayment, $snapToken);
            });
        }
        if ($paymentType === "UAS") {
            $uasPayment = UasPayment::where("snap_token", $oldSnapToken)->first();
            $dataPayment = (object) $this->dataPayment($uasPayment);
            DB::transaction(function () use ($dataPayment) {
                $midtrans = new CreateSnapToken($dataPayment);
                $snapToken = $midtrans->getSnapToken();
                // update
                return $this->uasUpdateSnap($dataPayment, $snapToken);
            });
        }
    }

    public function dataPayment($payment)
    {
        $orderId = 'spp-' . uniqid();
        $dataPayment = [
            "id" => $payment->id,
            "order_id" => $orderId,
            "nominal_pembayaran" => $payment->nominal_pembayaran,
            "jenis_pembayaran" => $payment->jenis_pembayaran,
            "nama_siswa" => $payment->siswa->nama,
            "email" => $payment->siswa->user->email,
            "no_hp" => $payment->siswa->no_hp
        ];
        return $dataPayment;
    }

    public function utsUpdateSnap($dataPayment, $snapToken)
    {
        try {
            $utsSnap = UtsPayment::where('id', $dataPayment->id)->update(['order_id' => $dataPayment->order_id, 'snap_token' => $snapToken, "status_pembayaran" => "pending"])->first();
            return $utsSnap;
        } catch (\Throwable $th) {
            return response()->json(["errors" => $th->getMessage()], 500);
        }
    }
    public function uasUpdateSnap($dataPayment, $snapToken)
    {
        try {
            $uasPayment = UasPayment::where('id', $dataPayment->id)->update(['order_id' => $dataPayment->order_id, 'snap_token' => $snapToken, "status_pembayaran" => "pending"])->first();
            return $uasPayment;
        } catch (\Throwable $th) {
            return response()->json(["errors" => $th->getMessage()], 500);
        }
    }
}
