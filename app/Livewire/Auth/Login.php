<?php

namespace App\Livewire\Auth;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Login extends Component
{
    use LivewireAlert;

    public $email, $password, $remember_me;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            $this->alert('success', 'Login berhasil');
            return redirect()->route('dashboard');
        }else{
            $this->alert('error', 'Email atau password salah');
        }

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->email = '';
        $this->password = '';
        $this->remember_me = false;
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.default', ['title' => 'Login']);
    }
}
