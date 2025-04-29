<?php

namespace App\Livewire\Home;

use App\Models\Favorite;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FilmList extends Component
{
    public $films = [];
    public $favoriteFilms = [];

    public function mount()
    {
        $cacheKey = 'films_list';
        $cachedFilms = Cache::remember($cacheKey, now()->addMinutes(120), function () {
            return Movie::inRandomOrder()->limit(12)->get()->toArray();
        });

        $this->films = $cachedFilms;

        $this->favoriteFilms = Favorite::where('user_id', Auth::id())
            ->pluck('movie_id')
            ->toArray();
    }

    public function loadMore()
    {
        $loadedIds = collect($this->films)->pluck('id')->toArray();

        $newFilms = Movie::whereNotIn('id', $loadedIds)
            ->inRandomOrder()
            ->limit(12)
            ->get()
            ->toArray();

        $this->films = array_merge($this->films, $newFilms);
    }

    public function saveFavorite($id)
    {
        if (!Auth::check()) {
            $this->dispatch('show-alert', type: 'error', message: 'You are not logged in!');
            return redirect()->route('login');
        }

        $favorite = Favorite::where('user_id', Auth::id())
            ->where('movie_id', $id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $this->dispatch('favorite-updated', ['id' => $id, 'status' => false]);
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'movie_id' => $id
            ]);
            $this->dispatch('favorite-updated', ['id' => $id, 'status' => true]);
        }

        $this->favoriteFilms = Favorite::where('user_id', Auth::id())
            ->pluck('movie_id')
            ->toArray();
    }


    public function detailFilm($uuid)
    {
        return redirect()->route('film.detail',['uuid'=>$uuid]);
    }

    public function render()
    {
        return view('livewire.home.film-list', ['films' => $this->films]);
    }
}
