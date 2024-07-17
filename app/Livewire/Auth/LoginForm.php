<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class LoginForm extends Component
{
    public $username;
    public $password;

    public function authenticate()
    {
        dd($this->username);
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
