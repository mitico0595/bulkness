<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Search;
use Illuminate\Http\Request;

class SearchApiController extends Controller
{
    public function index(Request $req)
    {
        $q = trim((string) $req->get('q'));
        $items = Search::query()
            ->when($q, function($qq) use ($q){
                $qq->where('name','like',"%$q%")
                   ->orWhere('codigo','like',"%$q%");
            })
            ->orderBy('name')
            ->limit(15)
            ->get(['id','name','image','precio','stock']);

        return response()->json(['data' => $items]);
    }
}
