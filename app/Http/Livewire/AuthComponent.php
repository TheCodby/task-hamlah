<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthComponent extends Component
{
    public $page = 'login'; // Default to login
    public $name, $email, $password, $password_confirmation;
    public $errorMessage;

    public function showRegister()
    {
        $this->resetInputs();
        $this->page = 'register';
    }

    public function showLogin()
    {
        $this->resetInputs();
        $this->page = 'login';
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->to('/');
        } else {
            $this->errorMessage = "Invalid credentials";
        }
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);
        return redirect()->to('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('/');
    }

    private function resetInputs()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->errorMessage = null;
    }

    public function render()
    {
        return view('livewire.auth-component');
    }
}
