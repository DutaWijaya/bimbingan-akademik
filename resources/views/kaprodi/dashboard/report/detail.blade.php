@extends('kaprodi.layouts.schema')

@section('kaprodi-mainbar')
    <div class="m-4 h-auto border w-100 overflow-auto">
        <header class="p-4 d-flex justify-content-center align-items-center flex-column">
            <h3 class="fw-bolder border-bottom">Detail Report Bimbingan</h3>
            <p>DAFTAR EVALUASI BIMBINGAN</p>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </header>

        <div class="mx-5 mb-5 pb-3 d-flex justify-content-center align-items-center flex-column">
            @if (count($semuaEvaluasi) > 0)
                <div class="row m-3 row-gap-4">
                    @foreach ($semuaEvaluasi as $evaluasi)
                        <div class="col-lg-6 mb-3 mb-sm-0">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">
                                        {{ \Carbon\Carbon::create($evaluasi->tgl_evaluasi)->locale('id')->translatedFormat('d F Y') }}
                                    </h5>
                                    <label for="masalah" class="w-100">
                                        Permasalahan
                                        <textarea disabled name="masalah" id="masalah" class="form-control">{{ $evaluasi->masalah }}</textarea>
                                    </label>
                                    <label for="solusi" class="w-100">
                                        Solusi
                                        <textarea disabled name="solusi" id="solusi" class="form-control">{{ $evaluasi->solusi }}</textarea>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    Tidak ada data ditemukan
                </div>
            @endif

            <a href="/dashboard-kaprodi/report" class="btn btn-primary">Kembali</a>
        </div>
    </div>
@endsection
