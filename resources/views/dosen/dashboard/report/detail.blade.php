@extends('dosen.layouts.schema')

@section('dosen-mainbar')
<div class="m-4 h-auto border w-100">
  <header class="p-4 d-flex justify-content-center align-items-center flex-column">
    <h3 class="fw-bolder border-bottom">Evaluasi Bimbingan</h3>
    <p>DETAIL BIMBINGAN MAHASISWA</p>
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
  </header>

  <div class="mx-5 mb-5 pb-3">
    <form action="/dashboard-dosen/report/evaluasi/edit/{{ $evaluasi->id_evaluasi }}" method="post" class="d-flex flex-column w-100 gap-3">
      @method('PUT')
      @csrf

      <main class="d-flex gap-3">
        <div class="card-wrapper w-50">
          <span class="fs-4">Masalah</span>
          <div class="card">
            <div class="card-body">
              {{ $evaluasi->masalah }}
            </div>
          </div>
        </div>

        <div class="card-wrapper w-50">
          <span class="fs-4">Solusi</span>
          @error('solusi')<span class="text-danger">* {{ $message }}</span>@enderror
          <div class="card">
            <div class="form-floating">
            <textarea autofocus class="form-control" name="solusi" placeholder="Leave a comment here" id="floatingTextarea2" style="height: auto">{{ $evaluasi->solusi  }}</textarea>
            <label for="floatingTextarea2">Berikan Solusi</label>
          </div>
          </div>
        </div>
      </main>

      <footer class="d-flex justify-content-end align-items-center gap-2">
        <div class="form-check">
          <input type="hidden" name="selesai" value="0">
          <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="selesai" {{ $evaluasi->selesai == 'true' ? 'checked' : '' }}>
          <label class="form-check-label" for="flexCheckChecked">
            Tandai sudah selesai
          </label>
        </div>
        <a href="/dashboard-dosen/report" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Kirim</button>
      </footer>

    </form>
  </div>
</div>
@endsection
