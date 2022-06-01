@extends('siswa.template.siswaContainer')
@section('title', $title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron d-flex flex-row">
                    <table class="table flex-grow-1" >
                        <tbody>
                            <tr>
                                <td>NAMA</td>
                                <td>:</td>
                                <td>{{ $siswa->nama }}</td>
                            </tr>
                            <tr>
                                <td>P/L</td>
                                <td>:</td>
                                <td>{{ $siswa->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td>Jurusan</td>
                                <td>:</td>
                                <td>{{ $siswa->jurusan->jurusan }}</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td>{{ $siswa->kelas->kelas }}</td>
                            </tr>

                            @foreach ($siswa->payments as $payment)
                            <tr>
                              <td scope="row">Jumlah Pembayaran</td>
                              <td>:</td>
                              <td>Rp. {{ $payment->nominal_pembayaran }}</td>
                            </tr>
                            <tr>
                              <td scope="row">UTS</td>
                              <td>:</td>
                              <td>
                                @if ($payment->pembayaran_uts == 1)
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                                @endif
                              </td>
                            </tr>
                            <tr>
                              <td scope="row">UAS</td>
                              <td>:</td>
                              <td>
                                @if ($payment->pembayaran_uas == 1)
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                                @endif
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
                <form action="#" id="form-payments">
                    @csrf
                    <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
                    <input type="text" name="id_siswa" value="{{ config('services.midtrans.client') }}">
                    <div class="mb-3">
                        <label for="nominal-pembayaran" class="form-label">Nominal Pembayaran</label>
                        <input type="text" class="form-control" name="nominal-pembayaran" id="nominal-pembayaran">
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-payment">checkout</button>
                </form>
            </div>
        </div>

        {{-- JS API Midtrans --}}
         {{-- js jquery --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    {{-- setting js untuk snap midtrans --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client') }}">
    </script>

    <script>
        // $("#form-payments").submit(function(event) {
        //     event.preventDefault();
        //     $.post("/api/pembayaran", {
        //         _method: 'POST',
        //         _token: '{{ csrf_token() }}',
        //         id_siswa: $("input[name=id_siswa]").val(),
        //         nama: $('input#nominal-pembayaran').val(),
        //         pembayaran_uts: 1,
        //         pembayaran_uas: 0,
        //     },
        //     function (data, status) {
        //         console.log(data);
        //         snap.pay(data.snap_token, {
        //             // Optional
        //             onSuccess: function (result) {
        //                 location.reload();
        //             },
        //             // Optional
        //             onPending: function (result) {
        //                 location.reload();
        //             },
        //             // Optional
        //             onError: function (result) {
        //                 location.reload();
        //             }
        //         });
        //         return false;
        //     });
        // })
        const form = document.querySelector('#form-payments');
        const btn = document.querySelector('#btn-payment');

    </script>
    </div>

@endsection
