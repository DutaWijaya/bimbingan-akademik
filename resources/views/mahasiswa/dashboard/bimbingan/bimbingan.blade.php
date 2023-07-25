@extends('mahasiswa.layouts.schema')

@section('mahasiswa-mainbar')
<div class="m-4 h-auto border">
  <header class="p-4 d-flex justify-content-center align-items-center flex-column">
    <h3 class="fw-bolder border-bottom">Form Bimbingan</h3>
    <p>Status Mahasiswa</p>
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
  </header>

  <div class="mx-5 mb-5 pb-3">
    <a href="/dashboard-mahasiswa/bimbingan/tambah" class="btn btn-success my-4">Tambah Data</a>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">ID Bimbingan</th>
          <th scope="col">Semester</th>
          <th scope="col">T.A</th>
          <th scope="col">Status</th>
          <th scope="col">IPK</th>
          <th scope="col">IPS</th>
          <th scope="col">Ranking</th>
          <th scope="col">Beasiswa</th>
          <th scope="col">Surat Peringatan</th>
          <th scope="col">Opsi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data->formbimbingan->sortBy('semester') as $bimbingan )
        <tr>
          <th scope="row">#{{ $bimbingan->id_bimbingan }}</th>
          <td>{{ $bimbingan->semester }}</td>
          <td>{{ $bimbingan->tahun_akademik }}</td>
          <td>{{ $bimbingan->status }}</td>
          <td>{{ $bimbingan->ipk }}</td>
          <td>{{ $bimbingan->ips }}</td>
          <td>{{ $bimbingan->peringkat }}</td>
          <td>{{ $bimbingan->beasiswa }}</td>
          <td>{{ $bimbingan->surat_peringatan }}</td>
          <td>
            <a href="/dashboard-mahasiswa/bimbingan/edit/{{ $bimbingan->id_bimbingan }}" class="btn btn-primary">Ubah</a>
            <a href="/dashboard-mahasiswa/bimbingan/evaluasi/{{ $bimbingan->id_bimbingan }}" class="btn btn-success">Evaluasi</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


@endsection
