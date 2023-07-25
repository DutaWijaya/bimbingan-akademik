@extends('mahasiswa.layouts.schema')

@section('mahasiswa-mainbar')

  <div class="m-4 h-auto border p-5 d-flex gap-4 flex-column justify-content-center align-items-center">
    <header class="p-4 d-flex justify-content-center align-items-center flex-column">
      <h3 class="fw-bolder border-bottom">Tambah Form Bimbingan</h3>
      <p>Status Mahasiswa</p>
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </header>

    <div class="mx-5 mb-5 pb-3">
      <form action="/dashboard-mahasiswa/bimbingan/tambah" class="w-100 row"  method="post" style="max-width: 700px;">
      @csrf
        <div class="mb-3 col-lg-6">
          <label for="semester" class="form-label">Semester</label>
          <select class="form-select" aria-label="Default select example" name="semester">
            <option value="1" selected>1</option>
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
            <option value="2018/2019">2018/2019</option>
            <option value="2019/2020">2019/2020</option>
            <option value="2020/2021">2020/2021</option>
            <option value="2021/2022">2021/2022</option>
            <option value="2022/2023">2022/2023</option>
            <option value="2023/2024" selected>2023/2024</option>
          </select>
        </div>

        <div class="mb-3 col-lg-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" aria-label="Default select example" name="status">
            <option value="Aktif" selected>Aktif</option>
            <option value="Cuti">Cuti</option>
            <option value="Drop Out">Drop Out</option>
          </select>
        </div>

        <div class="mb-3 col-lg-3">
          <label for="ipk" class="form-label">Ipk</label>
          <input type="text" value="{{ old('ipk') }}" class="form-control  @error('ipk')
            is-invalid
          @enderror" id="ipk" name="ipk">
          @error('ipk')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3 col-lg-3">
          <label for="ips" class="form-label">Ips</label>
          <input type="text" value="{{ old('ips') }}" class="form-control  @error('ips')
            is-invalid
          @enderror" id="ips" name="ips">
          @error('ips')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3 col-lg-3">
          <label for="peringkat" class="form-label ">Peringkat</label>
          <input type="text" value="{{ old('peringkat') }}" class="form-control @error('peringkat')
            is-invalid
          @enderror" id="peringkat" name="peringkat">
          @error('peringkat')
          <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3 col-lg-6">
          <label for="beasiswa" class="form-label">Beasiswa</label>
          <textarea class="form-control @error('beasiswa')
            is-invalid
          @enderror" id="beasiswa" name="beasiswa" rows="3">{{ old('beasiswa') }}</textarea>
          @error('beasiswa')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3 col-lg-6">
          <label for="surat_peringatan" class="form-label">Surat Peringatan</label>
          <textarea class="form-control @error('surat_peringatan') is-invalid @enderror" name="surat_peringatan" id="surat_peringatan" rows="3">{{ old('surat_peringatan') }}</textarea>
          @error('surat_peringatan')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3 col-lg-12 d-flex gap-2 justify-content-end">
          <a href="{{ route('dashboard-mahasiswa.bimbingan') }}" class="btn btn-danger">Batal</a>
          <button type="submit" class="btn btn-success">Tambah</button>
        </div>

      </form>
    </div>
  </div>
@endsection
