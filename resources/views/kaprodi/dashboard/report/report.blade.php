@extends('kaprodi.layouts.schema')

@section('kaprodi-mainbar')
    <div class="m-4 h-auto border w-100 overflow-auto">
        <header class="p-4 d-flex justify-content-center align-items-center flex-column">
            <h3 class="fw-bolder border-bottom">Report Bimbingan</h3>
            <p>DAFTAR MAHASISWA BIMBINGAN</p>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </header>

        <div class="mx-5 mb-5 pb-3 d-flex justify-content-center align-items-center flex-column">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">NAMA</th>
                        <th scope="col" class="text-center">SEMESTER</th>
                        <th scope="col" class="text-center">T.A</th>
                        <th scope="col" class="text-center">STATUS</th>
                        <th scope="col" class="text-center">JUMLAH EVALUASI</th>
                        <th scope="col" class="text-center">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($semuaData) > 0)
                        @foreach ($semuaData as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama }}</td>
                                <td class="text-center">{{ $data->semester }}</td>
                                <td class="text-center">{{ $data->tahun_akademik }}</td>
                                <td class="text-center">{{ $data->status }}</td>
                                <td class="text-center">{{ $data->jumlah_evaluasi }}</td>
                                <td class="text-center"><a href="/dashboard-kaprodi/report/{{ $data->id_bimbingan }}"
                                        class="btn btn-primary">
                                        <x-fas-eye style="width: 17px; margin: 0 5px" />Lihat Evaluasi
                                    </a></td>
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
        </div>
    </div>
@endsection
