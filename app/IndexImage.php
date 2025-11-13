<?php

// app/IndexImage.php
namespace App;

use Illuminate\Database\Eloquent\Model;

class IndexImage extends Model
{
    protected $fillable = ['image', 'relacion', 'campaign_id'];

    protected $casts = [
        'relacion' => 'array', // guardaremos un array de IDs de Search
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function getImageUrlAttribute()
    {
        // public/image/index/...
        return asset('image/index/' . $this->image);
    }
}
