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

    public function getSnapToken($data)
    {
        $params = [
            'transaction_details' => [
                'order_id' => 'spp-' . $this->data->siswa_id,
                'gross_amount' => $this->data->nominal_pembayaran,
            ],
            'item_details' => [
                [
                    'id' => 1, // primary key produk
                    'price' => $this->data->nominal_pembayaran, // harga satuan produk
                    'quantity' => 1, // kuantitas pembelian
                    'name' => 'spp-' . $this->data->nama_siswa, // nama produk
                ],
            ],
            'customer_details' => [
                'first_name'    => $this->data->nama_siswa,
                'email'         => "siswa@gmail.com",
                'phone' => $this->data->no_hp,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        return $snapToken;
    }
}
