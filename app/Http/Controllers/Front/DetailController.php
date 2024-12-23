<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($slug)
    {
        $datas = Item::with(['brand', 'type'])->where('slug', $slug)->first();
        return view('detail', compact('datas'));
    }
}

