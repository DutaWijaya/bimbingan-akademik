@extends('mahasiswa.layouts.schema')

@section('mahasiswa-mainbar')
  <div class="m-4 h-auto border p-5 d-flex gap-4 flex-column justify-content-center align-items-center">
    <header class="p-4 d-flex justify-content-center align-items-center flex-column">
      <h3 class="fw-bolder border-bottom">Evaluasi Bimbingan</h3>
      <p>Menambahkan evaluasi pada form bimbingan semester {{ $formbimbingan->semester }}, tahun akademik {{ $formbimbingan->tahun_akademik }}</p>
    </header>


    <div class="mx-5 mb-5 pb-3">
      <form action="/dashboard-mahasiswa/bimbingan/evaluasi/{{ $formbimbingan->id_bimbingan }}" method="post" class="w-100 row" style="max-width: 700px;">
        @csrf
        <div class="mb-3">
          <label for="tanggal_evaluasi" class="form-label @error('tanggal_evaluasi')
          is-invalid
          @enderror">Tanggal Evaluasi</label>
          <input type="date" class="form-control" id="tanggal_evaluasi" name="tanggal_evaluasi" value="{{ old('tanggal_evaluasi') }}">
          @error('tanggal_evaluasi')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="masalah" class="form-label @error('masalah')
          is-invalid
          @enderror">Masalah</label>
          <textarea name="masalah" class="form-control" id="masalah">{{ old('masalah') }}</textarea>
          @error('masalah')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3 d-flex justify-content-end gap-3">
          <a href="{{ route('dashboard-mahasiswa.bimbingan') }}" class="btn btn-danger">Kembali</a>
          <button type="submit" class="btn btn-success">Kirim</button>
        </div>
      </form>
    </div>
  </div>
@endsection