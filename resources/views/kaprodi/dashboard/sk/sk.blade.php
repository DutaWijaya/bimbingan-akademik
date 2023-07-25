@extends('kaprodi.layouts.schema')

@section('kaprodi-mainbar')
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

        <div class="mx-5 mb-5 pb-3 d-flex justify-content-center align-items-center flex-column">
            <div class="d-flex justify-content-center align-items-center gap-4 ms-auto">
                <form action="/dashboard-kaprodi/sk" class="my-3 ms-auto d-flex gap-2">
                    <label for="search"></label>
                    <input type="text" class="form-control" name="search" id="search"
                        placeholder="Nama sk, nama Berkas">
                    <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center gap-1">
                        <x-carbon-search style="width: 20px" />Cari
                    </button>
                </form>
                <a href="/dashboard-kaprodi/sk/tambah" class="btn btn-success ms-auto my-2">
                    <span class="d-flex gap-2 fw-bold justify-content-center align-items-center">
                        <x-carbon-folder-add style="width: 20px" />Tambah SK
                    </span>
                </a>
            </div>
            <div class="table-responsive w-100">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="">
                                NO
                            </th>
                            <th scope="col" class="w-25">NAMA</th>
                            <th scope="col">TANGGAL</th>
                            <th scope="col">BERKAS</th>
                            <th scope="col" class="text-center">OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($semuaSk) > 0)
                            @foreach ($semuaSk as $sk)
                                <tr>
                                    <td>{{ ($semuaSk->currentpage() - 1) * $semuaSk->perpage() + $loop->index + 1 }}</td>
                                    <td>{{ $sk->nama_sk }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sk->tgl_sk)->locale('id')->translatedFormat('d F Y') }}
                                    </td>
                                    <td>
                                        <a class="badge bg-secondary text-decoration-none" download="{{ $sk->nama_berkas }}"
                                            href="{{ asset('storage/' . $sk->link) }}">
                                            <span class="d-flex justify-content-center align-items-center gap-1">
                                                <x-carbon-cloud-download style="width: 20px" />{{ $sk->nama_berkas }}
                                            </span>
                                        </a>
                                    </td>
                                    <td class="d-flex gap-1 justify-content-center align-items-center">
                                        <a href="" class="btn btn-success" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" data-bs-title="Tooltip on bottom">
                                            <span class="d-flex gap-1 justify-content-center align-items-center">
                                                <x-fas-eye style="width: 17px" />
                                            </span>
                                        </a>
                                        <a href="/dashboard-kaprodi/sk/update/{{ $sk->no_sk }}" class="btn btn-primary">
                                            <span class="d-flex gap-1 justify-content-center align-items-center">
                                                <x-fas-pen-to-square style="width: 15px" />
                                            </span>
                                        </a>
                                        <form action="/dashboard-kaprodi/sk/{{ $sk->no_sk }}" method="POST"
                                            class="inline">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                onclick="return confirm('Anda yakin ingin menghapus {{ $sk->nama_sk }}')"
                                                class="btn btn-danger">
                                                <span class="d-flex gap-1 justify-content-center align-items-center">
                                                    <x-fas-trash style="width: 14px" />
                                                </span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <p class="text-center my-3 text-danger">Data tidak tersedia</p>
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
