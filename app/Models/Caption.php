<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Caption extends Model
{
    use HasFactory;
    protected $fillable=[
      'uuid',
      'title',
      'description'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->uuid = Str::uuid()->toString();
        });
    }
}
