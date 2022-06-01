<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorepaymentRequest;
use App\Http\Requests\UpdatepaymentRequest;
use App\Models\Siswa;
use App\Services\Midtrans\CreateSnapToken;

use function PHPUnit\Framework\isNull;

class PaymentController extends Controller
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::where('user_id', auth()->user()->id)->with('jurusan')->with('kelas')->with('payments')->first();
        // dd($siswa->payments);
        $payment =  $siswa->payments[0];
        $payment["nama_siswa"] = $siswa->nama;
        $payment["no_hp"] = $siswa->no_hp;
        $payment["nis"] = $siswa->nis;
        // dd($payment);
        if (!$payment->snap_token) {
            // dd($payment);
            $midtrans = new CreateSnapToken($payment);
            $snapToken = $midtrans->getSnapToken();
            // $payment->snap_token = $snapToken;
            Payment::where('id', $payment->id)->update(['snap_token' => $snapToken]);
        }
        return view(
            'siswa.paymentDetail',
            [
                'siswa' => $siswa,
                'token' => $siswa->payments[0]->snap_token,
                'title' => 'Data Pembayaran'
            ]
        );
    }

    public function notification(Request $request)
    {

        $repp = "KOKOKO";
        return $repp;

        $notif = new \Midtrans\Notification();
        // dd($notif);

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::where('user_id', auth()->user()->id)->with('jurusan')->with('kelas')->with('payments')->first();
        return view('siswa.paymentCreate', ['siswa' => $siswa, 'title' => 'Pembayaran SPP']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepaymentRequest $request)
    {
        // dd($request);
        $siswa = Siswa::where('id', $request->id_siswa)->first();
        $request['nama'] = $siswa->nama;
        $request["user_id"] = $siswa->user_id;
        $request['nis'] = $siswa->nis;
        $request['no_hp'] = $siswa->no_hp;
        $request['pembayaran_uts'] = 1;
        $request['pembayaran_uas'] = 0;
        \DB::transaction(function () use ($request) {
            $payment = Payment::create([
                'siswa_id' => $request->id_siswa,
                'nominal_pembayaran' => floatval($request->nominal_pembayaran),
                'pembayaran_uts' => $request->pembayaran_uts,
                'pembayaran_uas' => $request->pembayaran_uas,
            ]);
            $payload = [
                'transaction_details' => [
                    'order_id'      => 'SPP-' . $payment->id,
                    'gross_amount'  => $payment->nominal_pembayaran,
                ],
                'customer_details' => [
                    'first_name'    => $request->nama,
                    'email'         => "siswa@gmail.com",
                ],
                'item_details' => [
                    [
                        'id'       => 'spp-siswa' + $payment->siswa_id,
                        'price'    => $payment->nominal_pembayaran,
                        'quantity' => 1,
                        'name'     => ucwords(str_replace('_', ' ', $request->nama)),
                    ]
                ]
            ];
            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            $payment->snap_token = $snapToken;
            $payment->save();

            $this->response['snap_token'] = $snapToken;
        });
        return response()->json($this->response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepaymentRequest  $request
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepaymentRequest $request, payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(payment $payment)
    {
        //
    }
}
