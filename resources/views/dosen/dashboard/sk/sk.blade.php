@extends('dosen.layouts.schema')

@section('dosen-mainbar')
    <div class="m-4 h-auto border w-100 overflow-auto">
        <header class="p-4 d-flex justify-content-center align-items-center flex-column">
            <h3 class="fw-bolder border-bottom">Surat Keputusan</h3>
            <p>DAFTAR SURAT KEPUTUSAN</p>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </header>

        <div class="mx-5 mb-5 pb-3">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td scope="col" class="text-center fw-bold">NO</td>
                            <td scope="col" class="text-center fw-bold">NAMA SK</td>
                            <td scope="col" class="text-center fw-bold">TANGGAL</td>
                            <td scope="col" class="text-center fw-bold">DOWNLOAD</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($semuaSk) > 0)
                            @foreach ($semuaSk as $sk)
                                <tr class="">
                                    <td class="text-center" style="width: 10%">
                                        {{ ($semuaSk->currentpage() - 1) * $semuaSk->perpage() + $loop->index + 1 }}</td>
                                    <td class="" style="width: 40%">{{ $sk->nama_sk }}</td>
                                    <td class="text-center" style="width: 20%">
                                        {{ \Carbon\Carbon::create($sk->tgl_sk)->locale('id')->translatedFormat('d F Y') }}
                                    </td>
                                    <td style="width: 30%">
                                        <a class="badge bg-secondary text-decoration-none" download="{{ $sk->nama_berkas }}"
                                            href="{{ asset('storage/' . $sk->link) }}">
                                            <span class="d-flex justify-content-center align-items-center gap-1">
                                                <x-carbon-cloud-download style="width: 20px" />{{ $sk->nama_berkas }}
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="alert alert-danger w-50 m-auto" role="alert">
                                        Tidak ada data ditemukan
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $semuaSk->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
