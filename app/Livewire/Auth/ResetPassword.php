<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ResetPassword extends Component
{
    #[Title("Thiết lập lại mật khẩu | PHIMHAY")]

    public $email, $token, $password, $password_confirmation;

    protected $rules = [
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required|min:6',
    ];

    protected $messages = [
        'password.required' => 'password is required.',
        'password.min' => 'password must be at least 6 characters.',
        'password.confirmed' => 'password does not match.',
        'password_confirmation.required' => 'Password confirmation is required.',
    ];

    public function mount($token)
    {
        $this->email = request()->query('email');
        $this->token = $token;
    }

    public function resetPassword()
    {
        $this->validate();

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
//                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            $this->dispatch('show-alert', type: 'success', message: 'Your password has been reset.!');
            return redirect('login');
        } else {
            $this->dispatch('show-alert', type: 'error', message: 'Your password changed!!');
        }
    }

    public function login() {
        return redirect('/login');
    }

    #[Layout('layouts.auth')]
    public function render()
    {
        return view('livewire.auth.resetpassword');
    }
}
