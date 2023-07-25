<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\FormEvaluasi;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use App\Models\SuratKeputusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardKaprodiController extends Controller
{
  public function profile()
  {
    $data = Kaprodi::findOrFail(Auth::id());
    return view('kaprodi.dashboard.profile.profile', [
      'title' => 'Dashboard Kaprodi',
      'kaprodi' => $data,
    ]);
  }

  public function profileEdit()
  {
    $data = Kaprodi::findOrFail(Auth::id());
    return view('kaprodi.dashboard.profile.edit', [
      'title' => 'Ubah',
      'kaprodi' => $data,
    ]);
  }

  public function profileUpdate(Request $request) {
    $kaprodi = Auth::user();
    $credentials = $request->validate([
      'nama' => 'required|min:3',
      'foto'   => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
    ], [
      'nama.required' => 'Nama harus diisi',
      'nama.min' => 'Nama minimal 3 karakter',

    ]);
        if ($request->file('foto')) {
      $credentials['foto'] = $request->file('foto')->store('foto');
    }
    $kaprodi->update($credentials);
    return redirect('/dashboard-kaprodi')->with('success', 'Data berhasil diubah');
  }

  public function kelola(Request $request)
  {
    $nip = Auth::id();
    $searchQuery = $request->search;
    $data = Mahasiswa::with(['dosen', 'kaprodi'])->where('kaprodi_nip', $nip);

    if ($searchQuery) {
      $data->where(function ($query) use ($searchQuery) {
        $query->where('nama', 'like', '%' . $searchQuery . '%')
          ->orWhere('nim', 'like', '%' . $searchQuery . '%')
          ->orWhereHas('dosen', function ($query) use ($searchQuery) {
            $query->where('nama', 'like', '%' . $searchQuery . '%')
              ->orWhere('nip', 'like', '%' . $searchQuery . '%');
          });
      });
    }

    return view('kaprodi.dashboard.kelola.kelola', [
      'title' => 'Kelola',
      'semuaData' => $data->get(),
    ]);
  }

    public function ubahBimbingan($nim) {
    $mahasiswa = Mahasiswa::findOrFail($nim);
    $semuaDosen = Dosen::where('prodi', Auth::user()->prodi)->get();
    return view('kaprodi.dashboard.kelola.ubah', [
      'title' => 'Kelola',
      'semuaDosen' => $semuaDosen,
      'mahasiswa' => $mahasiswa,
    ]);
  }

 public function updateBimbingan(Request $request, $nim) {

    $mahasiswa = Mahasiswa::find($nim);
    $dosen = Dosen::find($request->dosen);

    // dd($mahasiswa);

    $mahasiswa->update([
      'dosen_nip' => $request['dosen']
    ]);

    $mahasiswa->save();
    return redirect('/dashboard-kaprodi/kelola')->with('success', 'Pembimbing mahasiswa '. $mahasiswa->nama .' berhasil diperbaharui');
  }

  // repot

 public function report() {
    $nip = auth()->user()->nip;

    $data = DB::table('mahasiswa')
      ->select('mahasiswa.nama','form_bimbingan.id_bimbingan', 'form_bimbingan.semester', 'form_bimbingan.tahun_akademik', 'form_bimbingan.status', DB::raw('COUNT(form_evaluasi.id_evaluasi) as jumlah_evaluasi'))
      ->leftJoin('form_bimbingan', 'mahasiswa.nim', '=', 'form_bimbingan.nim')
      ->leftJoin('form_evaluasi', 'form_bimbingan.id_bimbingan', '=', 'form_evaluasi.id_bimbingan')
      ->where('mahasiswa.kaprodi_nip', $nip)
      ->whereNotNull('form_bimbingan.id_bimbingan') // Hanya ambil mahasiswa yang memiliki form_bimbingan
      ->groupBy('mahasiswa.nama', 'form_bimbingan.id_bimbingan', 'form_bimbingan.semester', 'form_bimbingan.tahun_akademik', 'form_bimbingan.status')
      ->get();

      // dd($data);

    return view('kaprodi.dashboard.report.report', [
      'title' => 'Report',
      'semuaData' => $data,
    ]);
  }

  public function detailReport($id_bimbingan) {
    $data = FormEvaluasi::where('id_bimbingan', $id_bimbingan)->get();
    return view('kaprodi.dashboard.report.detail', [
      'title' => 'Detail Evaluasi',
      'semuaEvaluasi' => $data,
    ]);
  }


  public function sk(Request $request) {


    $data = SuratKeputusan::with(['kaprodi'])->where('kaprodi_nip', auth()->user()->nip);
    $searchQuery = $request->search;

    if($request->search) {
      $data->where(function ($query) use ($searchQuery) {
        $query->where('nama_sk', 'like', '%' . $searchQuery . '%')
          ->orWhere('tgl_Sk', 'like', '%' . $searchQuery . '%')
          ->orWhere('nama_berkas', 'like', '%' . $searchQuery . '%');
        });
    }
    // dd($data->get());


    return view('kaprodi.dashboard.sk.sk', [
      'title' => 'Surat Keputusan',
      'semuaSk' => $data->paginate(5)->withQueryString(),
    ]);
  }

  public function addSk() {
    return view('kaprodi.dashboard.sk.add', [
      'title' => 'Tambah Surat Keputusan',
    ]);
  }

  public function storeSk(Request $request) {

    $credentials = $request->validate([
      'nama_sk' => ['required'],
      'tgl_sk' => ['required'],
      'fileSk' => ['required', 'max:10000', 'mimes:doc,pdf,docx']
    ], [
      'nama_sk.required' => 'Nama surat tidak boleh kosong',
      'tgl_sk.required' => 'Tanggal tidak boleh kosong',
      'fileSk.required' => 'File tidak boleh kosong',
      'fileSk.max' => 'File tidak boleh melebihi 10mb',
      'fileSk.mimes' => 'File dalam bentuk doc, pdf atau docx',
    ]);


    if($request->file('fileSk')) {
      $credentials['fileSk'] = $request->file('fileSk')->store('sk');
    }

		$lastId = DB::table('surat_keputusan')->max('no_sk');
		$newId = $lastId + 1;

    DB::table('surat_keputusan')->insert([
      'no_sk' => $newId,
      'nama_sk' => $request->nama_sk,
      'tgl_sk' => $request->tgl_sk,
      'link' => $request->file('fileSk')->store('sk'),
      'nama_berkas' => $request->file('fileSk')->getClientOriginalName(),
      'kaprodi_nip' => auth()->user()->nip,
    ]);

    return redirect('/dashboard-kaprodi/sk')->with('success', 'Surat Keterangan berhasil ditambah');
  }

  public function destroy($no_sk) {
    SuratKeputusan::destroy($no_sk);
    return redirect('/dashboard-kaprodi/sk')->with('success', 'Surat Keterangan berhasil dihapus');
  }

  public function editSk($no_sk) {
    $sk = SuratKeputusan::findOrFail($no_sk);
    return view('kaprodi.dashboard.sk.update', [
      'title' => 'Ubah',
      'sk' => $sk
    ]);
  }

  public function updateSk(Request $request, $no_sk) {

    $sk = SuratKeputusan::findOrFail($no_sk);

    $credentials = $request->validate([
      'nama_sk' => ['required'],
      'tgl_sk' => ['required'],
      'link' => ['max:10000', 'mimes:doc,pdf,docx']
    ], [
      'nama_sk.required' => 'Nama surat tidak boleh kosong',
      'tgl_sk.required' => 'Tanggal tidak boleh kosong',
      'link.max' => 'File tidak boleh melebihi 10mb',
      'link.mimes' => 'File dalam bentuk doc, pdf atau docx',
    ]);

    if($request->file('link')) {
      $credentials['link'] = $request->file('link')->store('sk');
    }

    if($request->file('link')) {
      $sk->update([
        'nama_sk' => $request->nama_sk,
        'tgl_sk' => $request->tgl_sk,
        'link' => $request->file('link')->store('sk'),
        'nama_berkas' => $request->file('link')->getClientOriginalName(),
      ]);
    } else {
      $sk->update([
        'nama_sk' => $request->nama_sk,
        'tgl_sk' => $request->tgl_sk,
      ]);
    }

    return redirect('/dashboard-kaprodi/sk')->with('success', 'Surat Keterangan berhasil update');
  }
}
