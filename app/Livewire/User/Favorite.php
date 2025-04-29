<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Favorite extends Component
{
    use WithPagination;

    #[Title('Favorite')]
    #[Layout('layouts.app')]
    protected $paginationTheme = 'bootstrap';

    public $favoriteFilms = [];

    public function mount()
    {
        $this->favoriteFilms = \App\Models\Favorite::where('user_id', Auth::id())
            ->pluck('movie_id')
            ->toArray();
    }

    public function saveFavorite($id)
    {
        $favorite = \App\Models\Favorite::where('user_id', Auth::id())
            ->where('movie_id', $id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $this->dispatch('favorite-updated', ['id' => $id, 'status' => false]);
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'movie_id' => $id,
            ]);
            $this->dispatch('favorite-updated', ['id' => $id, 'status' => true]);
        }

        $this->favoriteFilms = \App\Models\Favorite::where('user_id', Auth::id())
            ->pluck('movie_id')
            ->toArray();
    }

    public function detailFilm($uuid){
        return redirect()->route('film.detail',['uuid' => $uuid]);
    }

    public function profile()
    {
        return $this->redirect('profile');
    }

    public function render()
    {
        $userId = Auth::id();

        $data = \App\Models\Favorite::join('movies', 'movies.id', '=', 'favorites.movie_id')
            ->join('movie_genres', 'movies.id', '=', 'movie_genres.movie_id')
            ->join('genres', 'movie_genres.genre_id', '=', 'genres.id')
            ->select(
                'movies.*',
                DB::raw("GROUP_CONCAT(genres.title SEPARATOR ', ') as genre_title")
            )
            ->where('favorites.user_id', $userId)
            ->groupBy('movies.id')
            ->paginate(18);

        return view('livewire.user.favorite', [
            'data' => $data,
        ]);
    }
}
