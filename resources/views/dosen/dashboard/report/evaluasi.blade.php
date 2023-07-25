@extends('dosen.layouts.schema')

@section('dosen-mainbar')
<div class="m-4 h-auto border w-100">
  <header class="p-4 d-flex justify-content-center align-items-center flex-column">
    <h3 class="fw-bolder border-bottom">Evaluasi Bimbingan</h3>
    <p>DAFTAR EVALUASI BIMBINGAN MAHASISWA</p>
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
  </header>


  <div class="mx-5 mb-5 pb-3">
  <div class="table-responsive">
    <table class="table table-hover align-middle overflow-auto">
      <thead>
        <tr>
          <th scope="col">NO</th>
          <th scope="col">ID</th>
          <th scope="col">TANGGAL</th>
          <th scope="col">MASALAH</th>
          <th scope="col">STATUS</th>
          <th scope="col">AKSI</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($daftarEvaluasi as $evaluasi)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>#{{ $evaluasi->id_evaluasi }}</td>
          <td>{{ \Carbon\Carbon::parse($evaluasi->tgl_evaluasi)->locale('id')->translatedFormat('d F Y') }}</td>
          <td>{{ $evaluasi->masalah }}</td>
          <td>
            <div class="badge {{ $evaluasi->selesai === 'true' ? 'text-bg-success' : 'text-bg-danger' }}">
              {{ $evaluasi->selesai === 'true' ? 'Selesai' : 'Belum Selesai' }}
            </div>
          </td>
          <td>
            <a href="/dashboard-dosen/report/evaluasi/{{ $evaluasi->id_evaluasi }}" class="btn btn-primary">Detail</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
</div>
@endsection
