@extends('mahasiswa.layouts.schema')

@section('mahasiswa-mainbar')
  <div class="m-4 h-auto border p-5 d-flex gap-4 flex-column justify-content-center align-items-center">
    <header class=" d-flex justify-content-center align-items-center flex-column">
      <h3 class="fw-bolder border-bottom">Ubah Form Bimbingan</h3>
      <p>Status Mahasiswa</p>
    </header>

    <form action="/dashboard-mahasiswa/bimbingan/edit/{{ $formbimbingan->id_bimbingan }}" method="post" class="w-100 row"
      style="max-width: 700px;">
      @method('PUT')
      @csrf
      <div class="mb-3 col-lg-6">
        <label for="semester" class="form-label">Semester</label>
        <select class="form-select" aria-label="Default select example" name="semester">
          <option selected class="bg-primary" value="{{ $formbimbingan->semester }}">{{ $formbimbingan->semester }}
          </option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
        </select>
      </div>

      <div class="mb-3 col-lg-6">
        <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
        <select class="form-select" aria-label="Default select example" name="tahun_akademik">
          <option selected class="bg-primary" value="{{ $formbimbingan->tahun_akademik }}">
            {{ $formbimbingan->tahun_akademik }}</option>
          <option value="2018/2019">2018/2019</option>
          <option value="2019/2020">2019/2020</option>
          <option value="2020/2021">2020/2021</option>
          <option value="2021/2022">2021/2022</option>
          <option value="2022/2023">2022/2023</option>
          <option value="2023/2024">2023/2024</option>
        </select>
      </div>

      <div class="mb-3 col-lg-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" aria-label="Default select example" name="status">
          <option selected class="bg-primary" value="{{ $formbimbingan->status }}">{{ $formbimbingan->status }}</option>
          <option value="Aktif">Aktif</option>
          <option value="Cuti">Cuti</option>
          <option value="Drop Out">Drop Out</option>
        </select>
      </div>

      <div class="mb-3 col-lg-3">
        <label for="ipk" class="form-label">Ipk</label>
        <input type="text" class="form-control" value="{{ $formbimbingan->ipk }}" name="ipk">
      </div>

      <div class="mb-3 col-lg-3">
        <label for="ips" class="form-label">Ips</label>
        <input type="text" class="form-control" value="{{ $formbimbingan->ips }}" name="ips">
      </div>

      <div class="mb-3 col-lg-3">
        <label for="peringkat" class="form-label">Peringkat</label>
        <input type="text" class="form-control" value="{{ $formbimbingan->peringkat }}" name="peringkat">
      </div>

      <div class="mb-3 col-lg-6">
        <label for="beasiswa" class="form-label">Beasiswa</label>
        <textarea class="form-control" name="beasiswa" rows="3">{{ $formbimbingan->beasiswa }}</textarea>
      </div>

      <div class="mb-3 col-lg-6">
        <label for="beasiswa" class="form-label">Surat Peringatan</label>
        <textarea class="form-control" name="surat_peringatan" rows="3">{{ $formbimbingan->surat_peringatan }}</textarea>
      </div>

      <div class="mb-3 col-lg-12 d-flex gap-2 justify-content-end">
        <a href="{{ route('dashboard-mahasiswa.bimbingan') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </form>

  </div>
@endsection
