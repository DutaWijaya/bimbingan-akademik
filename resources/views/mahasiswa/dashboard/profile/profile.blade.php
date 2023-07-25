@extends('mahasiswa.layouts.schema')

@section('mahasiswa-mainbar')

<div class="m-4 h-auto border">
  <header class="p-4 d-flex justify-content-center align-items-center flex-column">
    <h3 class="fw-bolder border-bottom">Profil Mahasiswa</h3>
    <p>Profil lengkap mahasiswa</p>
    {{-- @dd($mahasiswa) --}}
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
        <img class="w-100 h-100 object-fit-cover" src="{{ asset('storage/' . $mahasiswa->foto) }}">
      </div>
      <h4 class="fw-bold mb-0 mt-3 text-center">{{ $mahasiswa->nama }}</h4>
      <p class="text-center">Mahasiswa {{ $mahasiswa->prodi }}, jurusan {{ $mahasiswa->jurusan }}</p>
    </div>
    <div class="col-lg-9 row">

      <div class="col-lg-6 p-3">
        <label for="nama">Nama</label>
        <input type="text" value="{{ $mahasiswa->nama }}" class="form-control disabled" disabled>
      </div>

      <div class="col-lg-6 p-3">
        <label for="nim">NIM</label>
        <input type="text" value="{{ $mahasiswa->nim }}" class="form-control disabled" disabled>
      </div>

      <div class="col-lg-6 p-3">
        <label for="alamat">Alamat</label>
        <input type="text" value="{{ $mahasiswa->alamat }}" class="form-control disabled" disabled>
      </div>

      <div class="col-lg-6 p-3">
        <label for="telepon">Telepon</label>
        <input type="text" value="{{ $mahasiswa->no_hp }}" class="form-control disabled" disabled>
      </div>

      <div class="col-lg-6 p-3">
        <label for="jurusan">Jurusan</label>
        <input type="text" value="{{ $mahasiswa->jurusan }}" class="form-control disabled" disabled>
      </div>

      <div class="col-lg-6 p-3">
        <label for="prodi">Program Studi</label>
        <input type="text" value="{{ $mahasiswa->prodi }}" class="form-control disabled" disabled>
      </div>

      <h5 class="fw-bolder text-center pt-4">Profil Orang Tua</h5>

      <div class="col-lg-4 px-3">
        <label for="nama_orangtua">Nama Orang Tua</label>
        <input type="text" value="{{ $mahasiswa->nama_orangtua }}" class="form-control disabled" disabled>
      </div>

      <div class="col-lg-4 px-3">
        <label for="alamat_orangtua">Alamat Orang Tua</label>
        <input type="text" value="{{ $mahasiswa->alamat_orangtua }}" class="form-control disabled" disabled>
      </div>

      <div class="col-lg-4 px-3">
        <label for="no_hp_orangtua">Telepon Orang Tua</label>
        <input type="text" value="{{ $mahasiswa->no_hp_orangtua ??  '' }}" class="form-control disabled" disabled>
      </div>

      <h5 class="fw-bolder text-center pt-5 pb-2">Informasi Dosen Pembimbing & Kepala Prodi</h5>
      <div class="col-lg-6 px-3">
        <label for="dosen">Dosen Pembimbing</label>
        <input type="text" value="{{ $mahasiswa->dosen->nama ?? '' }} ({{ $mahasiswa->dosen->nip ?? '' }})" class="form-control disabled" disabled>
      </div>

      <div class="col-lg-6 px-3">
        <label for="kaprodi">Kepala Prodi</label>
        <input type="text" value="{{ $mahasiswa->kaprodi->nama ?? ''}} ({{ $mahasiswa->kaprodi->nip ?? '' }})" class="form-control disabled" disabled>
      </div>

      <div class="col-lg-12 px-3 py-5 d-flex">
        <a href="/dashboard-mahasiswa/edit" class="btn border ms-auto">Ubah Data</a>
      </div>
    </div>
  </div>
</div>

@endsection
