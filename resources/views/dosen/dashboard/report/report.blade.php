@extends('dosen.layouts.schema')

@section('dosen-mainbar')
<div class="m-4 h-auto border w-100 overflow-auto">
  <header class="p-4 d-flex justify-content-center align-items-center flex-column">
    <h3 class="fw-bolder border-bottom">Evaluasi Bimbingan</h3>
    <p>DAFTAR MAHASISWA BIMBINGAN</p>
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
  </header>


  <div class="mx-5 mb-5 pb-3">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">NO</th>
          <th scope="col">NIM</th>
          <th scope="col">NAMA</th>
          <th scope="col">EVALUASI</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($daftarMahasiswa as  $mahasiswa)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $mahasiswa->nim }}</td>
          <td>{{ $mahasiswa->nama }}</td>
          <td>
            <a href="/dashboard-dosen/report/{{ $mahasiswa->nim }}" class="btn btn-primary">Evaluasi</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection