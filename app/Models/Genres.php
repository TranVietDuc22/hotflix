<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Genres extends Model
{
    protected $fillable=[
        'uuid',
        'title',
        'description',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_genres','genre_id', 'movie_id')->withTimestamps();
    }
}
