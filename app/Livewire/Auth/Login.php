<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    #[Title('Đăng nhập | PHIMHAY')]

    public $email, $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    protected $messages = [
        'email.required' => 'Email is required.',
        'email.email' => 'Email is not valid.',
        'password.required' => 'Password is required.',
    ];

    public function login()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            $this->dispatch('show-alert', type: 'error', message: 'Email is not exist!');
        } else {
            if ($user->is_verified == 0) {
                $this->dispatch('show-alert', type: 'error', message: 'Your user is not verified');
            } else {
                if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                    $this->dispatch('show-alert', type: 'success', message: 'Login successful!');
                    $this->reset();
                    return redirect('/');
                } else {
                    $this->dispatch('show-alert',  type: 'error', message: 'Password is incorrect!');
                }
            }
        }
    }

    public function forgetPass()
    {
        return $this->redirect('forget-password');
    }

    public function register()
    {
        return redirect()->to('/register');
    }
    #[Layout('layouts.auth')]
    public function render()
    {
        return view('livewire.auth.login');
    }
}
