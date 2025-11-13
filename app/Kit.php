<?php
// app/Kit.php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    protected $fillable = ['search_id','name','price','meta'];
    protected $casts = ['meta' => 'array', 'price' => 'decimal:2'];

    public function principal() {
        return $this->belongsTo(Search::class, 'search_id');
    }
    public function items() {
        return $this->hasMany(KitItem::class);
    }
    public function products() {
        return $this->belongsToMany(Search::class, 'kit_items', 'kit_id', 'search_id')->withPivot('qty')->withTimestamps();
    }
}

