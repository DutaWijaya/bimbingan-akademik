<ul class="list-group list-group-flush" style="width: 300px">
  <div class="w-full d-flex m-3 gap-3 justify-content-center align-items-center">
    <div class="overflow-hidden" style="width: 50px; height: 50px; border-radius: 999em">
        <img class="w-100 h-100 object-fit-cover" src="{{ asset('storage/' . auth()->user()->foto) }}">
    </div>
    <h5 class="m-0">{{ auth()->user()->nama }}</h5>
  </div>
  <a href="/dashboard-dosen" class="text-decoration-none"><li class="list-group-item {{ $title == 'Profile' ? 'bg-secondary-subtle' : '' }}">Profil </li></a>
  <a href="/dashboard-dosen/report" class="text-decoration-none"><li class="list-group-item {{ $title == 'report' ? 'bg-secondary-subtle' : '' }}">Evaluasi Bimbingan</li></a>
  <a href="/dashboard-dosen/riwayat" class="text-decoration-none"><li class="list-group-item {{ $title == 'Riwayat' ? 'bg-secondary-subtle' : '' }}">Riwayat</li></a>
  <a href="/dashboard-dosen/sk" class="text-decoration-none"><li class="list-group-item {{ $title == 'Surat Keputusan' ? 'bg-secondary-subtle' : '' }}">Download SK</li></a>
</ul>