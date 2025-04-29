<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dropdown extends Component
{
    public $user;

    public function mount(){
//        $this->user = Auth::user()->name;
    }

    public function profile(){
        return redirect()->route('user.profile');
    }

    public function favorite(){
        return redirect()->route('user.favorite');
    }

    public function logout(){
        return redirect()->route('logout');
    }

    public function render()
    {
        return view('livewire.user.dropdown',['user' => $this->user]);
    }
}
