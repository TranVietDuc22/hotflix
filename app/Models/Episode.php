<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'link_film',
        'episode',
    ];

    protected $casts = [
        'link_film' => 'json',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function setLinkFilmAttribute($value)
    {
        if (is_array($value)) {
            $formattedData = [];

            foreach ($value as $entry) {
                $server = $entry['server'] ?? 'Unknown Server';

                if (!isset($formattedData[$server])) {
                    $formattedData[$server] = [
                        'embed' => $entry['embed'] ?? null,
                    ];
                }
            }

            $this->attributes['link_film'] = json_encode($formattedData, JSON_UNESCAPED_SLASHES);
        } else {
            $this->attributes['link_film'] = $value;
        }
    }

}
