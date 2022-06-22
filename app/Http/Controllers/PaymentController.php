<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorepaymentRequest;
use App\Http\Requests\UpdatepaymentRequest;
use App\Models\Siswa;
use App\Models\UasPayment;
use App\Models\UtsPayment;
use App\Services\Midtrans\CreateSnapToken;
use Illuminate\Support\Facades\DB;

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
        $this->_createSnapToken();

        $siswa = Siswa::where('user_id', auth()->user()->id)
            ->with('jurusan')
            ->with('kelas')
            ->with('alamat')
            ->with('uasPayments')
            ->with('utsPayments')
            ->first();



        return view('siswa.paymentDetail', ['siswa' => $siswa, 'title' => 'Data Pembayaran']);
    }

    private function _createSnapToken()
    {
        $siswa = Siswa::where('user_id', auth()->user()->id)
            ->with('jurusan')
            ->with('kelas')
            ->first();
        $uasPayments = $siswa->uasPayments;
        $utsPayments = $siswa->utsPayments;

        foreach ($uasPayments as $key) {
            if (!$key->snap_token) {
                $key["nama_siswa"] = $siswa->nama;
                $key["no_hp"] = $siswa->no_hp;
                $key["nis"] = $siswa->nis;

                DB::transaction(function () use ($key) {
                    $midtrans = new CreateSnapToken($key);
                    $snapToken = $midtrans->getSnapToken();

                    // update
                    UasPayment::where('id', $key->id)->update(['snap_token' => $snapToken]);
                });
            }
        }

        foreach ($utsPayments as $key) {
            if (!$key->snap_token) {
                $key["nama_siswa"] = $siswa->nama;
                $key["no_hp"] = $siswa->no_hp;
                $key["nis"] = $siswa->nis;

                DB::transaction(function () use ($key) {
                    $midtrans = new CreateSnapToken($key);
                    $snapToken = $midtrans->getSnapToken();

                    // update
                    UtsPayment::where('id', $key->id)->update(['snap_token' => $snapToken]);
                });
            }
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepaymentRequest $request)
    {
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

        DB::transaction(function () use ($request) {
            $midtrans = new CreateSnapToken($request);
            $snapToken = $midtrans->getSnapToken();

            // update
            UtsPayment::where('id', $request->id)->update(['snap_token' => $snapToken]);
        });
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
