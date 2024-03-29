<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\UasPayment;
use App\Models\UtsPayment;
use App\Services\Midtrans\CreateSnapToken;
use Illuminate\Support\Facades\DB;

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
                $key["email"] = auth()->user()->email;
                // $key["jenis_pembayaran"] = $siswa->uasPayments->jenis_pembayaran;

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
                $key["email"] = auth()->user()->email;
                // $key["jenis_pembayaran"] = $siswa->utsPayments->jenis_pembayaran;

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
}
