<?php

namespace App\Livewire\Film;

use App\Models\Category;
use App\Models\Country;
use App\Models\Favorite;
use App\Models\Genres;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Browser extends Component
{
    use WithPagination;

    #[Title('Phim Hay')]
    public $uuid, $sourceTable, $browser;
    public $favoriteFilms = [];
    protected $paginationTheme = 'bootstrap';

    public function mount($uuid, $sourceTable)
    {
        $this->uuid = $uuid;
        $this->sourceTable = $sourceTable;
//        $this->loadData();
        $this->favoriteFilms = Favorite::where('user_id', Auth::id())
            ->pluck('movie_id')
            ->toArray();
    }

    public function loadData()
    {
        switch ($this->sourceTable) {
            case '1':
                $films  = Movie::join('movie_genres', 'movies.id', '=', 'movie_genres.movie_id')
                    ->join('genres', 'movie_genres.genre_id', '=', 'genres.id')
                    ->join('categories', 'movies.category_id', '=', 'categories.id')
                    ->select(
                        'movies.id as id',
                        'movies.poster as poster',
                        'movies.uuid as movie_uuid',
                        'movies.title as title',
                        'categories.uuid as category_uuid',
                        'categories.title as category_title',
                        DB::raw("GROUP_CONCAT(genres.title SEPARATOR ', ') as genre_title")
                    )
                    ->where('categories.uuid', '=', $this->uuid)
                    ->groupBy('movies.id')->paginate(18);
                $this->browser = Category::where('uuid', $this->uuid)->pluck('title')->first();
                break;
            case '2':
                $films  = Movie::join('movie_genres', 'movies.id', '=', 'movie_genres.movie_id')
                    ->join('genres', 'movie_genres.genre_id', '=', 'genres.id')
                    ->join('countries', 'movies.country_id', '=', 'countries.id')
                    ->select(
                        'movies.*',
                        'movies.uuid as movie_uuid',
                        'countries.uuid as country_uuid',
                        DB::raw("GROUP_CONCAT(genres.title SEPARATOR ', ') as genre_title")
                    )
                    ->where('countries.uuid', '=', $this->uuid)
                    ->groupBy('movies.id')
                    ->paginate(18);
                $this->browser = Country::where('uuid', $this->uuid)->pluck('name')->first();
                break;
            case '3':
                $films  = Movie::join('movie_genres', 'movies.id', '=', 'movie_genres.movie_id')
                    ->join('genres', 'movie_genres.genre_id', '=', 'genres.id')
                    ->select(
                        'movies.*',
                        'movies.uuid as movie_uuid',
                        'genres.uuid as genre_uuid',
                        'genres.title as genre_title',
                    )
                    ->where('genres.uuid', '=', $this->uuid)
                    ->paginate(18);
                $this->browser = Genres::where('uuid', $this->uuid)->pluck('title')->first();
                break;
            default:
                abort(404);
        }
        return $films;
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

    public function render()
    {
        $films = $this->loadData();
        return view('livewire.film.browser', ['films' => $films]);
    }

}
