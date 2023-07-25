<?php

namespace App\Http\Controllers;

use App\Models\FormBimbingan;
use App\Models\FormEvaluasi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardMahasiswaController extends Controller {

	public function profile() {
		$data = Mahasiswa::with(['dosen', 'kaprodi'])->find(Auth::id());
		return view('mahasiswa.dashboard.profile.profile', [
			'title' => 'Profile',
			'mahasiswa' => $data,
		]);
	}
	public function editProfile() {
		$data = Mahasiswa::with(['dosen', 'kaprodi'])->find(Auth::id());
		return view('mahasiswa.dashboard.profile.edit', [
			'title' => 'Edit',
			'mahasiswa' => $data
		]);
	}
	public function updateProfile(Request $request) {
		$mahasiswa = Auth::user();
		$credentials = $request->validate([
			'nama' 						=> ['required'],
			'alamat' 					=> ['required'],
			'no_hp' 					=> ['required'],
			'nama_orangtua'		=> ['required'],
			'alamat_orangtua'	=> ['required'],
			'no_hp_orangtua' 	=> ['required'],
      'foto'   => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000'],
		]);

    if ($request->file('foto')) {
      $credentials['foto'] = $request->file('foto')->store('foto');
    }

    $mahasiswa->update($credentials);
		return redirect('/dashboard-mahasiswa')->with('success', 'Profil berhasil diperbaharui');
	}

	public function bimbingan() {
		$data = Mahasiswa::with(['formbimbingan'])->find(Auth::id());
		return view('mahasiswa.dashboard.bimbingan.bimbingan', [
			'title' => 'Bimbingan',
			'data'  => $data,
		]);
	}

  public function addBimbingan() {
    return view('mahasiswa.dashboard.bimbingan.add', [
      'title' => 'Tambah'
    ]);
  }

  public function storeBimbingan(Request $request) {
    $credentials = $request->validate([
      'semester' => ['required'],
      'tahun_akademik' => ['required'],
      'status' => ['required'],
      'ipk' => ['required'],
      'ips' => ['required'],
      'peringkat' => ['required'],
      'beasiswa' => ['required'],
			'surat_peringatan' => ['required'],
    ], [
      'semester.required' => 'Semester tidak boleh kosong',
      'tahun_akademik.required' => 'Tahun Akademik tidak boleh kosong',
      'status.required' => 'Semester Status boleh kosong',
      'ipk.required' => 'IPK tidak boleh kosong',
      'ips.required' => 'IPS tidak boleh kosong',
      'peringkat.required' => 'Peringkat tidak boleh kosong',
      'beasiswa.required' => 'Beasiswa tidak boleh kosong',
			'surat_peringatan.required' => 'Surat Peringatan Tidak Boleh Kosong (- jika tidak ada)'
    ]);

		$lastId = DB::table('form_bimbingan')->max('id_bimbingan');
		$newId = $lastId + 1;

		DB::table('form_bimbingan')->insert([
			'id_bimbingan'			=> $newId,
			'semester' 					=> $request->semester,
      'tahun_akademik' 		=> $request->tahun_akademik,
      'status' 						=> $request->status,
      'ipk' 							=> $request->ipk,
      'ips' 							=> $request->ips,
      'peringkat' 				=> $request->peringkat,
      'beasiswa' 					=> $request->beasiswa,
      'surat_peringatan' 	=> $request->surat_peringatan,
			'nim'								=> auth()->user()->nim,
		]);

		return redirect(route('dashboard-mahasiswa.bimbingan'))->with('success', 'Data berhasil ditambah');
  }

	public function editBimbingan($id_bimbingan) {
		$data = FormBimbingan::with(['mahasiswa'])->findOrFail($id_bimbingan);
		return view('mahasiswa.dashboard.bimbingan.edit', [
			'title' => 'Ubah',
			'formbimbingan' => $data,
		]);
	}
	public function updateBimbingan(Request $request, $id_bimbingan) {
    $formbimbingan = FormBimbingan::findOrFail($id_bimbingan);
    $formbimbingan->update($request->all());
    return redirect('/dashboard-mahasiswa/bimbingan')->with('success', 'Form bimbingan berhasil diperbaharui');
	}

	public function evaluasiBimbingan($id_bimbingan) {
		$formbimbingan = FormBimbingan::findOrFail($id_bimbingan);
		return view('mahasiswa.dashboard.bimbingan.evaluasi', [
			'title' => 'Evaluasi',
			'formbimbingan' => $formbimbingan
		]);
	}

	public function storeEvaluasiBimbingan(Request $request, $id_bimbingan) {
		$credentials = $request->validate([
			'tanggal_evaluasi' => ['required'],
			'masalah' => ['required', 'min:3']
		], [
			'tanggal_evaluasi.required' => 'Tanggla evaluasi tidak boleh kosong',
			'masalah.required' => 'Masalah tidak boleh kosong',
			'masalah.min' => 'Minimal 3 kalimat'
		]);

		$lastId = DB::table('form_evaluasi')->max('id_evaluasi');
		$newId = $lastId + 1;

		DB::table('form_evaluasi')->insert([
			'id_evaluasi'				=> $newId,
			'tgl_evaluasi'	    => $request->tanggal_evaluasi,
			'masalah'						=> $request->masalah,
			'dosen_nip'			=> auth()->user()->dosen_nip,
			'id_bimbingan'			=> $id_bimbingan
		]);
		return redirect(route('dashboard-mahasiswa.bimbingan'))->with('success', 'Evaluasi berhasil ditambah pada form dengan id '. $id_bimbingan);
	}

	public function riwayat() {
//		$data = FormEvaluasi::all();
    $data = DB::table('mahasiswa')
      ->join('form_bimbingan', 'mahasiswa.nim', '=', 'form_bimbingan.nim')
      ->join('form_evaluasi', 'form_bimbingan.id_bimbingan', '=', 'form_evaluasi.id_bimbingan')
      ->select('mahasiswa.nama', 'form_bimbingan.*', 'form_evaluasi.*')
      ->where('mahasiswa.nim', Auth::id())
      ->orderBy('form_evaluasi.tgl_evaluasi', 'ASC')
      ->get();

		return view('mahasiswa.dashboard.riwayat.riwayat', [
			'title' => 'Riwayat',
			'data' => $data,
		]);
	}

  public function riwayatDetail($nim) {
    $data = FormEvaluasi::findOrFail($nim);
    return view('mahasiswa.dashboard.riwayat.detail', [
      'title' => 'Riwayat',
      'detail' => $data
    ]);
  }
}
