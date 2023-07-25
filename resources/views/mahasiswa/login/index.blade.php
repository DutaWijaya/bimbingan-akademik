<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }} | Bimbingan Akademik</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body style="height: 100vh; background-size: cover; background-image: url({{ asset('storage/hero/pnb2.jpg') }});" class="p-0 m-0 d-flex justify-content-center align-items-center">
  <div class="border rounded-1 bg-white d-flex gap-3 justify-content-center flex-column align-items-center" style="padding: 60px 80px">
    <header class="d-flex flex-column justify-content-center align-items-center">
      <h3 class="fw-bolder">Login Sebagai Mahasiswa</h3>
      <p>Masukan nim dan Password</p>

    @if(session()->has('login-error'))
      <p class="text-danger">{{ session('login-error') }}</p>
    @endif
    </header>
    <form action="/login-mahasiswa" method="POST" class="w-100 d-flex justify-content-center align-items-center flex-column" style="max-width: 400px">
      @csrf
      <div class="mb-3 w-100">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" class="form-control" id="nim" name="nim">
      </div>
      <div  class="mb-3 w-100">
        <label for="password" class="form-lable">PASSWORD</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="d-flex gap-2 m-3">
        <button type="submit" class="btn border btn-primary">Login</button>
        <a href="/" class="btn border btn-danger">Batal</a>
      </div>
    </form>
  </div>
</body>
</html>