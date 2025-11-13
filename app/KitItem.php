<?php
// app/KitItem.php
namespace App;

use Illuminate\Database\Eloquent\Model;

class KitItem extends Model
{
    protected $fillable = ['kit_id','search_id','qty'];

    public function kit() { return $this->belongsTo(Kit::class); }
    public function product() { return $this->belongsTo(Search::class, 'search_id'); }
}
