<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapToken extends Midtrans
{
    protected $data;

    public function __construct($data)
    {
        parent::__construct();
        $this->data = $data;
    }

    public function getSnapToken()
    {
        // dd($this->data);
        $params = [
            'transaction_details' => [
                'order_id' =>  $this->data->order_id,
                'gross_amount' => $this->data->nominal_pembayaran,
            ],
            'item_details' => [
                [
                    'id' => 1, // primary key produk
                    'price' => $this->data->nominal_pembayaran, // harga satuan produk
                    'quantity' => 1, // kuantitas pembelian
                    'name' => $this->data->jenis_pembayaran == 'mid-semester' ? "uts-" . ucwords(str_replace('_', ' ', $this->data->nama_siswa)) : "uas-" . ucwords(str_replace('_', ' ', $this->data->nama_siswa)) // nama produk
                ],
            ],
            'customer_details' => [
                'first_name'    => $this->data->nama_siswa,
                'email'         => $this->data->email,
                'phone' => $this->data->no_hp,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        return $snapToken;
    }
}
