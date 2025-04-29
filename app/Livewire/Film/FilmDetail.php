<?php

namespace App\Livewire\Film;

use App\Models\Episode;
use App\Models\Favorite;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class FilmDetail extends Component
{
    #[Title("Chi tiết phim")]
    public $film;
    public $favoriteFilms = [];

    public function mount($uuid)
    {
        $this->film = Movie::join('categories', 'movies.category_id', '=', 'categories.id')
            ->join('movie_genres', 'movies.id', '=', 'movie_genres.movie_id')
            ->join('genres', 'movie_genres.genre_id', '=', 'genres.id')
            ->join('countries', 'movies.country_id', '=', 'countries.id')
            ->select(
                'movies.*',
                'countries.name as country',
                'categories.title as category_title',
                DB::raw("GROUP_CONCAT(genres.title SEPARATOR ', ') as genre_title")
            )
            ->where('movies.uuid', $uuid)
            ->groupBy('movies.id')
            ->first();

        $this->favoriteFilms = Favorite::where('user_id', Auth::id())
            ->pluck('movie_id')
            ->toArray();
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

    public function render()
    {
        return view('livewire.film.film-detail', [
            'film' => $this->film,
        ]);
    }
}
