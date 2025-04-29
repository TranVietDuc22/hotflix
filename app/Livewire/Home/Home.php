<?php

namespace App\Livewire\Home;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    #[Title('PHIMHAY - Phim Mới, Phim Hay HD Vietsub, Thuyết Minh')]

    public function render()
    {
        return view('livewire.home.home');
    }
}
