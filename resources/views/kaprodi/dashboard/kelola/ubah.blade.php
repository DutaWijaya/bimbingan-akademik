@extends('kaprodi.layouts.schema')

@section('kaprodi-mainbar')
  <div class="m-4 h-auto border w-100 overflow-auto">
    <header class="p-4 d-flex justify-content-center align-items-center flex-column">
      <h3 class="fw-bolder border-bottom">Pilih Dosen</h3>
      <p>PILIH DOSEN PEMBIMBING</p>
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </header>


    <div class="mx-5 mb-5 pb-3 d-flex justify-content-center align-items-center flex-column">
      <form action="/dashboard-kaprodi/kelola/bimbingan/{{ $mahasiswa->nim }}" method="post" class="w-100 d-flex gap-3 justify-content-center align-items-end">
        @method('PUT')
        @csrf
        <label class="flex-grow-1 d-flex flex-column gap-2">
          Nama Mahasiswa
          <input type="text" class="form-control" placeholder="" value="{{ $mahasiswa->nama }}" disabled>
        </label>
        <label class="flex-grow-1 d-flex flex-column gap-2">
          Nama Dosen
          <select type="text" class="form-select" name="dosen">
            @foreach($semuaDosen as $dosen)
              <option value="{{ $dosen->nip }}">{{ $dosen->nama }} ({{ $dosen->nip }})</option>
            @endforeach
          </select>
        </label>
        <button type="submit" class="btn btn-primary">Pilih</button>
      </form>
    </div>
  </div>
@endsection
