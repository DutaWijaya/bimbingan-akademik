@extends('dosen.layouts.schema')

@section('dosen-mainbar')

  <div class="m-4 h-auto border">
    <header class="p-4 d-flex justify-content-center align-items-center flex-column">
      <h3 class="fw-bolder border-bottom">Profil Dosen</h3>
      <p>Profil lengkap Dosen</p>
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </header>

    <div class="row mx-5 mb-5 pb-3">
      <div class="col-lg-3 d-flex justify-content-center flex-column align-items-center">
        <div class="ratio bg-secondary-subtle" style="width: 200px; aspect-ratio: 3/4">
        <img class="w-100 h-100 object-fit-cover" src="{{ asset('storage/' . $dosen->foto) }}">
        </div>
        <h4 class="fw-bold mb-0 mt-3 text-center">{{ $dosen->nama }}</h4>
        <p class="text-center">{{ $dosen->prodi }}, jurusan {{ $dosen->jurusan }}</p>
      </div>
      <div class="col-lg-9 row">

        <div class="col-lg-6 p-3">
          <label for="nama">Nama Dosen</label>
          <input type="text" value="{{ $dosen->nama }}" class="form-control disabled" disabled>
        </div>

        <div class="col-lg-6 p-3">
          <label for="nip">NIP</label>
          <input type="text" value="{{ $dosen->nip }}" class="form-control disabled" disabled>
        </div>

        <div class="col-lg-6 p-3">
          <label for="telepon">Golongan</label>
          <input type="text" value="{{ $dosen->golongan }}" class="form-control disabled" disabled>
        </div>

        <div class="col-lg-6 p-3">
          <label for="jurusan">Jurusan</label>
          <input type="text" value="{{ $dosen->jurusan }}" class="form-control disabled" disabled>
        </div>

        <div class="col-lg-6 p-3">
          <label for="prodi">Program Studi</label>
          <input type="text" value="{{ $dosen->prodi }}" class="form-control disabled" disabled>
        </div>

        <div class="col-lg-12 px-3 py-5 d-flex">
          <a href="/dashboard-dosen/edit" class="btn border ms-auto">Ubah Data</a>
        </div>
      </div>
    </div>
  </div>

@endsection
