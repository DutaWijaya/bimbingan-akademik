<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\FormBimbingan;
use App\Models\FormEvaluasi;
use App\Models\Mahasiswa;
use App\Models\SuratKeputusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardDosenController extends Controller
{
  public function profile() {
    $data = Dosen::findOrFail(Auth::id());
		return view('dosen.dashboard.profile.profile', [
			'title' => 'Dashboard',
      'dosen' => $data,
		]);
	}
  public function profileEdit() {
    $data = Dosen::findOrFail(Auth::id());
    return view('dosen.dashboard.profile.edit', [
      'title' => 'Ubah',
      'dosen' => $data,
    ]);
  }
  public function profileUpdate(Request $request) {
    $dosen = Auth::user();
    $credentials = $request->validate([
      'nama'      => 'required|min:3',
      'golongan'  => 'required',
      'foto'   => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
    ], [
      'nama.required'     => 'Nama harus diisi',
      'nama.min'          => 'Nama minimal 3 karakter',
      'golongan.required' => 'Golongan harus diisi',
    ]);
        if ($request->file('foto')) {
      $credentials['foto'] = $request->file('foto')->store('foto');
    }
    $dosen->update($credentials);
    return redirect('/dashboard-dosen')->with('success', 'Data berhasil diubah');
  }
  public function reportBimbingan() {
    $data = Dosen::with(['mahasiswa'])->findOrFail(Auth::id());
    return view('dosen.dashboard.report.report', [
      'title' => 'Laporan Bimbingan',
      'daftarMahasiswa' => $data->mahasiswa,
    ]);
  }
  public function evaluasiBimbingan($nim) {
    $data = DB::table('mahasiswa')
      ->join('form_bimbingan', 'mahasiswa.nim', '=', 'form_bimbingan.nim')
      ->join('form_evaluasi', 'form_bimbingan.id_bimbingan', '=', 'form_evaluasi.id_bimbingan')
      ->select('mahasiswa.nama', 'form_bimbingan.*', 'form_evaluasi.*')
      ->where('mahasiswa.nim', $nim)
      ->orderBy('form_evaluasi.tgl_evaluasi', 'ASC')
      ->get();

    return view('dosen.dashboard.report.evaluasi', [
      'title' => 'Evaluasi Bimbingan',
      'daftarEvaluasi' => $data,
    ]);
  }
  public function detailEvaluasiBimbingan($nim) {
    $data = FormEvaluasi::findOrFail($nim);
    return view('dosen.dashboard.report.detail', [
      'title' => 'Detail Evaluasi Bimbingan',
      'evaluasi' => $data,
    ]);
  }
  public function updateEvaluasiBimbingan(Request $request, $id_evaluasi) {
    $request->validate([
      'solusi' => 'required',
    ], [
      'solusi.required' => 'Solusi harus diisi',
    ]);

    if ($request->selesai == '1') {
      DB::table('form_evaluasi')
        ->where('id_evaluasi', $id_evaluasi)
        ->update([
          'solusi' => $request->solusi,
          'selesai' => 'true',
        ]);
    } else {
      DB::table('form_evaluasi')
        ->where('id_evaluasi', $id_evaluasi)
        ->update([
          'solusi' => $request->solusi,
          'selesai' => 'false',
        ]);
    }

    return back()->with('success', 'Data berhasil disimpan.');
  }
  public function riwayat() {

    $data = Mahasiswa::with(['formbimbingan', 'formbimbingan.formevaluasi'])->whereHas('formbimbingan.formevaluasi', function ($query) {
      $query->where('selesai', 'true');
    })->orWhereHas('formbimbingan.formevaluasi', function ($query) {
      $query->where('selesai', 'false');
    })->get();

    return view('dosen.dashboard.riwayat.riwayat', [
      'title' => 'Riwayat',
      'daftarMahasiswa' => $data,
    ]);
  }
  public function riwayatList($id_evaluasi) {

    $formevaluasi = DB::table('form_evaluasi')
      ->whereIn('selesai', ['true', 'false'])
      ->whereIn('id_bimbingan', function ($query) use ($id_evaluasi) {
        $query->select('id_bimbingan')
          ->from('form_bimbingan')
          ->where('nim', $id_evaluasi);
      })
      ->orderBy('selesai', 'asc')
      ->get();

    return view('dosen.dashboard.riwayat.list', [
      'title' => 'Riwayat',
      'daftarEvaluasi' => $formevaluasi
    ]);
  }
    public function sk() {
    $data = SuratKeputusan::paginate(5)->withQueryString();
    return view('dosen.dashboard.sk.sk', [
      'title' => 'Surat Keputusan',
      'semuaSk' => $data
    ]);
  }
}
