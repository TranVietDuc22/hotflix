<?php

namespace App\Livewire\Home;

use App\Models\Movie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class Banner extends Component
{
    public $films = [];

    public function mount()
    {
        $this->films = Movie::orderBy('id', 'desc')->limit(5)->get();
        foreach ($this->films as &$film) {
            $film['description'] = Str::words($film['description'] ?? '', 40, '...');
        }
    }

    public function detailFilm($uuid){
        return redirect()->route('film.detail',['uuid'=>$uuid]);
    }

    public function render()
    {
        return view('livewire.home.banner', ['films' => $this->films]);
    }
}
