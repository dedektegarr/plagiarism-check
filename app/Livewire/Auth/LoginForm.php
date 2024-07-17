<?php

namespace App\Livewire\Auth;

use Exception;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginForm extends Component
{
    public $username;
    public $password;

    public function authenticate(Request $request)
    {
        try {
            $credentials = $this->validate([
                'username' => 'required|alpha_num',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials, true)) {
                $request->session()->regenerate();

                Session::flush();
                Session::flash('success', 'Login berhasil.');

                return $this->redirectIntended('/');
            }

            return redirect()->back()->with('error', 'Akun tidak ditemukan.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            Session::flash('error', 'Terjadi kesalahan saat login pengguna. Silakan coba lagi');
        }
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
