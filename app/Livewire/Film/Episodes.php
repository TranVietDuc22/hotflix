<?php

namespace App\Livewire\Film;

use App\Models\Episode;
use App\Models\Movie;
use Livewire\Component;

class Episodes extends Component
{
    public $vietsub, $thuyetminh, $activeEpisode;
    public $episodes = [];

    public function mount($uuid)
    {
        $movie = Movie::where('uuid', $uuid)->first();

        if ($movie) {
            if ($movie->total_episodes == 1) {
                $linkFilm = is_array($movie->link_film)
                    ? $movie->link_film
                    : json_decode($movie->link_film, true);

                if (!empty($linkFilm) && is_array($linkFilm)) {
                    $servers = array_values($linkFilm);

                    // ✅ Kiểm tra key trước khi truy xuất
                    $this->vietsub = isset($servers[0][0]['embed']) ? $servers[0][0]['embed'] : null;
                    $this->thuyetminh = isset($servers[1][0]['embed']) ? $servers[1][0]['embed'] : null;
                }

                $this->episodes = [['total_episodes' => 1]];
                return;
            }
        }

        $this->episodes = Episode::join('movies', 'episodes.movie_id', '=', 'movies.id')
            ->where('movies.uuid', $uuid)
            ->select(
                'movies.total_episodes as total_episodes',
                'episodes.link_film',
                'episodes.uuid',
                'episodes.episode'
            )
            ->get()
            ->toArray();

        if (!empty($this->episodes)) {
            $linkFilm = is_array($this->episodes[0]['link_film']) ? $this->episodes[0]['link_film'] : json_decode($this->episodes[0]['link_film'], true);

            if (!empty($linkFilm) && is_array($linkFilm)) {
                $this->vietsub = array_values($linkFilm)[0]['embed'] ?? null;
                $this->thuyetminh = array_values($linkFilm)[1]['embed'] ?? null;
            }
            $this->activeEpisode = $this->episodes[0]['uuid'];
        } else {
            $this->episodes = [['total_episodes' => 1]];
        }
    }
    public function loadStream($stream)
    {
        if (empty($this->episodes)) {
            return;
        }

        foreach ($this->episodes as $episode) {
            if ($episode['uuid'] === $stream) {
                $decoded = is_array($episode['link_film'])
                    ? $episode['link_film']
                    : json_decode($episode['link_film'], true);

                if (!empty($decoded) && is_array($decoded)) {
                    $this->vietsub = array_values($decoded)[0]['embed'] ?? null;
                    $this->thuyetminh = array_values($decoded)[1]['embed'] ?? null;
                } else {
                    $this->vietsub = null;
                    $this->thuyetminh = null;
                }

                $this->activeEpisode = $stream;
                break;
            }
        }
    }
    public function render()
    {
        return view('livewire.film.episodes',['episodes' => $this->episodes,]);
    }
}
