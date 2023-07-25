@extends('kaprodi.layouts.schema')

@section('kaprodi-mainbar')
  <div class="m-4 h-auto border w-100 overflow-auto">
    <header class="p-4 d-flex justify-content-center align-items-center flex-column">
      <h3 class="fw-bolder border-bottom">Kelola Bimbingan</h3>
      <p>DAFTAR MAHASISWA BIMBINGAN</p>
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </header>


    <div class="mx-5 mb-5 pb-3 d-flex justify-content-center align-items-center flex-column">
      <form action="/dashboard-kaprodi/kelola" class="my-3 ms-auto d-flex gap-2">
        <label for="search"></label>
        <input type="text" class="form-control" name="search" id="search" placeholder="Nama, nim, dosen pendamping, nip">
        <button type="submit" class="btn btn-primary">Cari</button>
      </form>
      <table class="table table-hover">
        <thead>
        <tr>
          <th scope="col">NO</th>
          <th scope="col">NAMA</th>
          <th scope="col">NIM</th>
          <th scope="col">DOSEN PEMBIMBING</th>
          <th scope="col">NIP</th>
          <th scope="col">AKSI</th>
        </tr>
        </thead>
        <tbody>
        @if(count($semuaData) > 0)
          @foreach($semuaData as $data)
            <tr>
          {{-- @dd($data) --}}
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->nama }}</td>
              <td>{{ $data->nim }}</td>
              <td>{{ $data->dosen->nama ?? '' }}</td>
              <td>{{ $data->dosen->nip ?? ''}}</td>
              <td><a href="/dashboard-kaprodi/kelola/{{ $data->nim }}" class="btn btn-primary">Kelola</a></td>
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
