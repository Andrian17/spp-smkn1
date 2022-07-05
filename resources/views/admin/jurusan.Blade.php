@extends('template.main')
@section('content')
    <div class="container">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Jurusan</li>
        </ol>
        <div class="row">
            @if (session()->has('pesan'))
                        {!! session('pesan') !!}
            @endif
            @foreach ($jurusan as $j)
                <div class="col-xl-3 col-lg-6">

                    <div class="card bg-primary {{ $style[array_rand($style)] }} mb-4">
                        <div class="card-body">
                            {{ $j->jurusan }} <span class="badge text-bg-danger">{{ $j->siswa->count() }}</span>
                        </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="/jurusan/{{ $j->id }}">Lihat Detail</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
