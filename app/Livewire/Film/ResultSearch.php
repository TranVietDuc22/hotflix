<?php

namespace App\Livewire\Film;

use App\Models\Favorite;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ResultSearch extends Component
{
    use WithPagination;


    #[Title("Searching...")]
    public $slug;
    public $favoriteFilms = [];
    protected $paginationTheme = 'bootstrap';


    public function mount()
    {
        $this->slug = request()->query('slug', '');
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

    public function detailFilm($uuid)
    {
        return redirect()->route('film.detail', ['uuid' => $uuid]);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $films = Movie::join('movie_genres', 'movies.id', '=', 'movie_genres.movie_id')
            ->join('genres', 'movie_genres.genre_id', '=', 'genres.id')
            ->select(
                'movies.*',
                DB::raw("GROUP_CONCAT(genres.title SEPARATOR ', ') as genre_title")
            )
            ->where('movies.title', 'like', "%{$this->slug}%")
            ->groupBy('movies.id')
            ->paginate(18);

        return view('livewire.film.result-search',
            [
                'films' => $films,
                'slug' => $this->slug,
            ]
        );
    }
}
