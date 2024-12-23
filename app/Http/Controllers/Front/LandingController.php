<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(){

        $datas = Item::with('brand', 'type')->latest()->take(8)->get()->reverse();

        return view('landing', compact('datas'));
    }
}
