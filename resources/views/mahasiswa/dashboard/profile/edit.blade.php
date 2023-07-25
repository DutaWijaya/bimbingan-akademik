@extends('mahasiswa.layouts.schema')

@section('mahasiswa-mainbar')
  <div class="p-3 m-4 border">
    <header class="p-4 d-flex justify-content-center align-items-center flex-column">
      <h3 class="fw-bolder border-bottom">Ubah Profil Mahasiswa</h3>
      <p>Ubah Profil lengkap mahasiswa</p>
    </header>

    <form action="/dashboard-mahasiswa/edit" method="post" class="row mx-5 mb-5 pb-3" enctype="multipart/form-data">
    @method('PUT')
    @csrf
      <div class="col-lg-3 d-flex justify-content-center flex-column align-items-center">
        <div class="ratio bg-secondary-subtle" style="width: 200px; aspect-ratio: 3/4">
          <img class="w-100 h-100 object-fit-cover" src="{{ asset('storage/' . $mahasiswa->foto) }}">
        </div>

        <div class="input-group m-4 d-flex ">
          <label for="foto">@error('foto') <span class="text-danger">{{ $message }}</span> @enderror</label>
          <input type="file" name="foto" class="form-control" id="foto">
        </div>

        <h4 class="fw-bold mb-0 text-center">{{ $mahasiswa->nama ?? '' }}</h4>
        <p class="text-center">Mahasiswa {{ $mahasiswa->prodi }}, jurusan {{ $mahasiswa->jurusan }}</p>
      </div>
      <div class="col-lg-9 row">
        <div class="col-lg-6 p-3">
          <label for="nama">Nama @error('nama') <span class="text-danger">({{ $message }})</span> @enderror</label>
          <input type="text" value="{{ $mahasiswa->nama }}" class="form-control" name="nama" autofocus>
        </div>

        <div class="col-lg-6 p-3">
          <label for="nim">NIM</label>
          <input type="text" value="{{ $mahasiswa->id }}" class="form-control" name="nim" disabled>
        </div>

        <div class="col-lg-6 p-3">
          <label for="alamat">Alamat @error('alamat') <span class="text-danger">({{ $message }})</span> @enderror</label>
          <input type="text" value="{{ $mahasiswa->alamat }}" name="alamat" class="form-control">
        </div>

        <div class="col-lg-6 p-3">
          <label for="telepon">Telepon @error('no_hp') <span class="text-danger">({{ $message }})</span> @enderror</label>
          <input type="text" value="{{ $mahasiswa->no_hp }}" name="no_hp" class="form-control">
        </div>

        <div class="col-lg-6 p-3">
          <label for="jurusan">Jurusan</label>
          <input type="text" value="{{ $mahasiswa->jurusan }}" name="jurusan" class="form-control disabled" disabled>
        </div>

        <div class="col-lg-6 p-3">
          <label for="prodi">Program Studi</label>
          <input type="text" value="{{ $mahasiswa->prodi }}" name="prodi" class="form-control disabled" disabled>
        </div>

        <h5 class="fw-bolder text-center pt-4">Profil Orang Tua</h5>

        <div class="col-lg-4 px-3">
          <label for="nama_orangtua">Nama Orang Tua @error('nama_orangtua') <span class="text-danger">({{ $message }})</span> @enderror</label>
          <input type="text" value="{{ $mahasiswa->nama_orangtua }}" name="nama_orangtua" class="form-control">
        </div>

        <div class="col-lg-4 px-3">
          <label for="alamat_orangtua">Alamat Orang Tu @error('alamat_orangtua') <span class="text-danger">({{ $message }})</span> @enderror</label>
          <input type="text" value="{{ $mahasiswa->alamat_orangtua }}" name="alamat_orangtua" class="form-control">
        </div>

        <div class="col-lg-4 px-3">
          <label for="no_hp_orangtua">Telepon Orang Tua @error('no_hp_orangtua') <span class="text-danger">({{ $message }})</span> @enderror</label>
          <input type="text" value="{{ $mahasiswa->no_hp_orangtua }}" name="no_hp_orangtua" class="form-control">
        </div>

        <h5 class="fw-bolder text-center pt-5 pb-2">Informasi Dosen Pendamping & Kepala Prodi</h5>
        <div class="col-lg-6 px-3">
          <label for="dosen">Dosen Pendamping</label>
          <input type="text" value="{{ $mahasiswa->dosen->nama ?? '' }} ({{ $mahasiswa->dosen->nip ?? '' }})" name="dosen" class="form-control disabled" disabled>
        </div>

        <div class="col-lg-6 px-3">
          <label for="kaprodi">Kepala Prodi</label>
          <input type="text" value="{{ $mahasiswa->kaprodi->nama ?? ''}} ({{ $mahasiswa->kaprodi->nip ?? '' }})" name="kaprodi" class="form-control disabled" disabled>
        </div>

        <div class="col-lg-12 px-3 py-5 d-flex justify-content-end gap-2">
          <a href="/dashboard-mahasiswa" class="btn btn-danger">Batal</a>
          <button type="submit" href="/dashboard-mahasiswa/edit" class="btn btn-success">Perbaharui Data</button>
        </div>
      </div>
    </form>
  </div>
@endsection
