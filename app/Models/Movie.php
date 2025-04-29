<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Movie extends Model
{
    use HasFactory;

    protected $fillable=[
        'uuid',
        'title',
        'link_film',
        'original_name',
        'description',
        'cast',
        'director',
        'time',
        'current_episode',
        'total_episodes',
        'year',
        'category_id',
        'country_id',
        'format_id',
        'caption_id',
        'banner',
        'poster',
        'is_film_hot',
        'status'
    ];

    protected $casts = [
        'is_film_hot' => 'boolean',
        'link_film' => 'json',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function format(): BelongsTo
    {
        return $this->belongsTo(Format::class);
    }

    public function caption(): BelongsTo
    {
        return $this->belongsTo(Caption::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genres::class, 'movie_genres','movie_id', 'genre_id')->withTimestamps();
    }

    public function setLinkFilmAttribute($value)
    {
        if (is_array($value)) {
            $formattedData = [];

            foreach ($value as $entry) {
                $server = $entry['server'] ?? 'Unknown Server';

                $episodeData = [
                    'name' => $entry['name'] ?? 'Unknown',
                    'embed' => $entry['embed'] ?? null,
                ];

                $formattedData[$server][] = $episodeData;
            }

            $this->attributes['link_film'] = json_encode($formattedData, JSON_UNESCAPED_SLASHES);
        } else {
            $this->attributes['link_film'] = $value;
        }
    }

}
