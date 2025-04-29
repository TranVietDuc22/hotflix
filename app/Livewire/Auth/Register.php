<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{
    #[Title('Đăng ký | PHIMHAY')]

    public $name, $email, $password, $password_confirmation;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed'
    ];

    protected $messages = [
        'name.required' => 'Name is required.',
        'email.required' => 'Email is required.',
        'email.email' => 'Email is not valid.',
        'email.unique' => 'Email already exist.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.confirmed' => 'Password confirm does not match.',
    ];
    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->sendEmailVerificationNotification();
        session()->flash('successRegister');
    }

    public function resendEmail(){
        $user = User::where('email', $this->email)->first();
        if ($user && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            session()->flash('resendEmail');
        } else {
            session()->flash('errorRegister');
        }
    }

    public function login()
    {
        return redirect('login');
    }

    #[Layout('layouts.auth')]
    public function render()
    {
        return view('livewire.auth.register');
    }
}
