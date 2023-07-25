<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMahasiswaController extends Controller
{
	public function index() {
		return view('mahasiswa.login.index', [
			'title' => 'login',
		]);
	}

	public function authenticate(Request $request) {
		$credentials = $request->validate([
			'nim'				=> ['required'],
			'password'	=> ['required'],
		]);

		if (Auth::guard('mahasiswa')->attempt($credentials)) {
			$request->session()->regenerate();
			return redirect()->intended('/dashboard-mahasiswa');
		}

		return back()->with([
			'login-error' => 'Nim atau password salah'
		]);
	}

  public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
  }
}
