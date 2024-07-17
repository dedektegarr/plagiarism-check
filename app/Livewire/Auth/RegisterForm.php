<?php

namespace App\Livewire\Auth;

use Exception;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class RegisterForm extends Component
{
    public $name;
    public $username;
    public $password;

    public function register()
    {
        try {
            $validated = $this->validate([
                'name' => 'required|min:1|regex:/^[\pL\s]+$/u',
                'username' => 'required|max:18|alpha_num|unique:users',
                'password' => 'required|min:6'
            ]);

            $validated['id'] = Str::uuid();
            $validated['username'] = strtolower($validated['username']);
            $validated['role'] = (int)strlen($validated['username']) === 9 ? 'mahasiswa' : 'dosen';
            $validated['password'] = bcrypt($validated['password']);

            $user = User::create($validated);

            Auth::loginUsingId($user->id, true);
            Session::flush();
            Session::flash('success', 'Login berhasil.');

            return redirect('/')->with('success', 'Registrasi berhasil.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            Session::flash('error', 'Terjadi kesalahan saat login pengguna. Silakan coba lagi');
        }
    }


    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
