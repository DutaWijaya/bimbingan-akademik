@extends('kaprodi.layouts.schema')

@section('kaprodi-mainbar')
    <div class="m-4 h-auto border mx-auto overflow-auto">
        <header class="p-4 d-flex justify-content-center align-items-center flex-column">
            <h3 class="fw-bolder border-bottom">Surat Keputusan</h3>
            <p>UBAH SURAT KEPUTUSAN</p>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </header>

        <div class="mx-5 mb-5 pb-3 d-flex justify-content-center align-items-center flex-column">
            <form action="/dashboard-kaprodi/sk/update/{{ $sk->no_sk }}" method="POST"
                class="d-flex flex-column justify-content-center align-items-center" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <tbody>
                            <tr>
                                <td><label for="nama_sk" class="text-nowrap">nama_sk Sk</label></td>
                                <td>
                                    @error('nama_sk')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" id="nama_sk" value="{{ $sk->nama_sk }}" name="nama_sk"
                                        class="form-control" value="{{ old('nama_sk') }}">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="tgl_sk" class="text-nowrap">tanggal</label></td>
                                <td><input type="date" id="tgl_sk" name="tgl_sk" class="form-control"
                                        value="{{ $sk->tgl_sk }}" required value="{{ old('tgl_sk') }}"></td>
                            </tr>
                            <tr>
                                <td><label for="oldSk">File Sebelumnya</label></td>
                                <td>
                                    <a class="badge bg-secondary text-decoration-none" download="{{ $sk->nama_berkas }}"
                                        href="{{ asset('storage/' . $sk->link) }}">
                                        <span class="d-flex justify-content-center align-items-center gap-1">
                                            <x-carbon-cloud-download style="width: 20px" />{{ $sk->nama_berkas }}
                                        </span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="link" class="text-nowrap">Ubah file</label></td>
                                <td>
                                    @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="file" id="link" name="link" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="d-flex justify-content-center align-items-center gap-2">
                                <a href="/dashboard-kaprodi/sk" class="btn ms-auto btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection
