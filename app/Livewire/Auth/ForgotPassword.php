<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ForgotPassword extends Component
{
    #[Title('Quên mật khẩu | PHIMHAY')]

    public $email;

    protected $rules = [
        'email' => 'required|email|exists:users,email',
    ];

    protected $messages = [
      'email.required' => 'Email is required.',
      'email.email' => 'Email is not valid.',
      'email.exists' => 'Email does not exist.',
    ];

    public function sendMail(){
        $this->validate();

        $status = Password::sendResetLink(['email' => $this->email]);

        if($status === Password::RESET_LINK_SENT){
            $this->dispatch('show-alert', type: 'success', message: 'Email send!');
        }else{
            $this->dispatch('show-alert', type: 'error', message: 'Something went wrong!');
        }
    }

    public function login()
    {
        return $this->redirect('login');
    }

    #[Layout('layouts.auth')]
    public function render()
    {
        return view('livewire.auth.forgotpassword');
    }
}
