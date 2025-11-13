<?php

// app/IndexImage.php
namespace App;

use Illuminate\Database\Eloquent\Model;

// app/Campaign.php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function indexImages()
    {
        return $this->hasMany(IndexImage::class);
    }
}
