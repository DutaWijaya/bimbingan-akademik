<ul class="list-group list-group-flush">
    <div class="w-full d-flex m-3 gap-3 justify-content-center align-items-center">
    <div class="overflow-hidden" style="width: 50px; height: 50px; border-radius: 999em">
        <img class="w-100 h-100 object-fit-cover" src="{{ asset('storage/' . auth()->user()->foto) }}">
    </div>
    <h5 class="m-0">{{ auth()->user()->nama }}</h5>
  </div>
  <a href="/dashboard-kaprodi" class="text-decoration-none"><li class="list-group-item {{ $title == 'Profile' ? 'bg-secondary-subtle' : '' }}">Profil</li></a>
  <a href="/dashboard-kaprodi/kelola" class="text-decoration-none"><li class="list-group-item {{ $title == 'Kelola' ? 'bg-secondary-subtle' : '' }}">Kelola Mahasiswa dan Dosen</li></a>
  <a href="/dashboard-kaprodi/report" class="text-decoration-none"><li class="list-group-item {{ $title == 'Report' ? 'bg-secondary-subtle' : '' }}">Report Bimbingan</li></a>
  <a href="/dashboard-kaprodi/sk" class="text-decoration-none"><li class="list-group-item {{ $title == 'Profile' ? 'bg-secondary-subtle' : '' }}">Surat Keputusan</li></a>
</ul>
