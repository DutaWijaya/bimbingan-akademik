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
<body>
  <div class="container-fluid p-0" style="height: 100vh; overflow: hidden;">
    @include('mahasiswa.layouts.navbar')
    <main class="container-fluid p-0 h-100 d-flex justify-content-center align-items-center">
      <article class="h-100 border-end" style="">
        @include('mahasiswa.layouts.sidebar')
      </article>
      <article class="flex-grow-1 h-100 p-0 m-0">
        @yield('mahasiswa-mainbar')
      </article>
    </main>
  </div>
</body>
</html>