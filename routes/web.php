<?php

use App\Http\Controllers\DashboardDosenController;
use App\Http\Controllers\DashboardKaprodiController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\LoginDosenController;
use App\Http\Controllers\LoginKaprodiController;
use App\Http\Controllers\LoginMahasiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', function() {
	return view('role', [
		'title' => 'Jabatan'
	]);
})->middleware('guest')->name('login');


// Mahasiswa Controller
Route::get('/login-mahasiswa', [LoginMahasiswaController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login-mahasiswa', [LoginMahasiswaController::class, 'authenticate']);
Route::post('/logout-mahasiswa', [LoginMahasiswaController::class, 'logout'])->middleware('auth:mahasiswa');
Route::get('/logout-mahasiswa', [LoginMahasiswaController::class, 'logout'])->middleware('auth:mahasiswa');
Route::get('/dashboard-mahasiswa', [DashboardMahasiswaController::class, 'profile'])->name('dashboard-mahasiswa')->middleware('auth:mahasiswa');
Route::get('/dashboard-mahasiswa/edit', [DashboardMahasiswaController::class, 'editProfile'])->middleware('auth:mahasiswa');
Route::put('/dashboard-mahasiswa/edit', [DashboardMahasiswaController::class, 'updateProfile'])->middleware('auth:mahasiswa');
Route::get('/dashboard-mahasiswa/bimbingan', [DashboardMahasiswaController::class, 'bimbingan'])->name('dashboard-mahasiswa.bimbingan')->middleware('auth:mahasiswa');
Route::get('/dashboard-mahasiswa/bimbingan/tambah', [DashboardMahasiswaController::class, 'addBimbingan'])->middleware('auth:mahasiswa');
Route::post('/dashboard-mahasiswa/bimbingan/tambah', [DashboardMahasiswaController::class, 'storeBimbingan'])->middleware('auth:mahasiswa');
Route::get('/dashboard-mahasiswa/bimbingan/edit/{id_bimbingan}', [DashboardMahasiswaController::class, 'editBimbingan'])->middleware('auth:mahasiswa');
Route::put('/dashboard-mahasiswa/bimbingan/edit/{id_bimbingan}', [DashboardMahasiswaController::class, 'updateBimbingan'])->middleware('auth:mahasiswa');
Route::get('/dashboard-mahasiswa/bimbingan/evaluasi/{id_bimbingan}', [DashboardMahasiswaController::class, 'evaluasiBimbingan'])->middleware('auth:mahasiswa');
Route::post('/dashboard-mahasiswa/bimbingan/evaluasi/{id_bimbingan}', [DashboardMahasiswaController::class, 'storeEvaluasiBimbingan'])->middleware('auth:mahasiswa');
Route::get('/dashboard-mahasiswa/riwayat', [DashboardMahasiswaController::class, 'riwayat'])->name('dashboard-mahasiswa.riwayat')->middleware('auth:mahasiswa');
Route::get('/dashboard-mahasiswa/riwayat/{id_evaluasi}', [DashboardMahasiswaController::class, 'riwayatDetail'])->middleware('auth:mahasiswa');

// Dosen Controller
Route::get('/login-dosen', [LoginDosenController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login-dosen', [LoginDosenController::class, 'authenticate']);
Route::post('/logout-dosen', [LoginDosenController::class, 'logout'])->middleware('auth:dosen');
Route::get('/dashboard-dosen', [DashboardDosenController::class, 'profile'])->middleware('auth:dosen');
Route::get('/dashboard-dosen/edit', [DashboardDosenController::class, 'profileEdit'])->middleware('auth:dosen');
Route::put('/dashboard-dosen/edit', [DashboardDosenController::class, 'profileUpdate'])->middleware('auth:dosen');
Route::get('/dashboard-dosen/report', [DashboardDosenController::class, 'reportBimbingan'])->middleware('auth:dosen');
Route::get('/dashboard-dosen/report/{nim}', [DashboardDosenController::class, 'evaluasiBimbingan'])->middleware('auth:dosen');
Route::get('/dashboard-dosen/report/evaluasi/{id_evaluasi}', [DashboardDosenController::class, 'detailEvaluasiBimbingan'])->middleware('auth:dosen');
Route::put('/dashboard-dosen/report/evaluasi/edit/{id_evaluasi}', [DashboardDosenController::class, 'updateEvaluasiBimbingan'])->middleware('auth:dosen');
Route::get('/dashboard-dosen/riwayat', [DashboardDosenController::class, 'riwayat'])->middleware('auth:dosen');
Route::get('/dashboard-dosen/riwayat/{nim}', [DashboardDosenController::class, 'riwayatList'])->middleware('auth:dosen');
Route::get('/dashboard-dosen/sk', [DashboardDosenController::class, 'sk'])->middleware('auth:dosen');
// Kaprodi Controller
Route::get('/login-kaprodi', [LoginKaprodiController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login-kaprodi', [LoginKaprodiController::class, 'authenticate']);
Route::post('/logout-kaprodi', [LoginKaprodiController::class, 'logout'])->middleware('auth:kaprodi');
Route::get('/dashboard-kaprodi', [DashboardKaprodiController::class, 'profile'])->middleware('auth:kaprodi');
Route::get('/dashboard-kaprodi/edit', [DashboardKaprodiController::class, 'profileEdit'])->middleware('auth:kaprodi');
Route::put('/dashboard-kaprodi/edit', [DashboardKaprodiController::class, 'profileUpdate'])->middleware('auth:kaprodi');

Route::get('/dashboard-kaprodi/kelola', [DashboardKaprodiController::class, 'kelola'])->middleware('auth:kaprodi');
Route::get('/dashboard-kaprodi/kelola/{nim}', [DashboardKaprodiController::class, 'ubahBimbingan'])->middleware('auth:kaprodi');
Route::put('/dashboard-kaprodi/kelola/bimbingan/{nim}', [DashboardKaprodiController::class, 'updateBimbingan'])->middleware('auth:kaprodi');
Route::get('/dashboard-kaprodi/report', [DashboardKaprodiController::class, 'report'])->middleware('auth:kaprodi');
Route::get('/dashboard-kaprodi/report/{id_bimbingan}', [DashboardKaprodiController::class, 'detailReport'])->middleware('auth:kaprodi');

Route::get('/dashboard-kaprodi/sk', [DashboardKaprodiController::class, 'sk'])->middleware('auth:kaprodi');
Route::get('/dashboard-kaprodi/sk/tambah', [DashboardKaprodiController::class, 'addSk'])->middleware('auth:kaprodi');
Route::post('/dashboard-kaprodi/sk/tambah', [DashboardKaprodiController::class, 'storeSk'])->middleware('auth:kaprodi');
Route::delete('/dashboard-kaprodi/sk/{no_sk}', [DashboardKaprodiController::class, 'destroy'])->middleware('auth:kaprodi');
Route::get('/dashboard-kaprodi/sk/update/{no_sk}', [DashboardKaprodiController::class, 'editSk'])->middleware('auth:kaprodi');
Route::put('/dashboard-kaprodi/sk/update/{no_sk}', [DashboardKaprodiController::class, 'updateSk'])->middleware('auth:kaprodi');