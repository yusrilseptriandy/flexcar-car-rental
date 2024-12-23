<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request, $slug){

        $item = Item::with('brand', 'type')->where('slug', $slug)->first();

        return view('checkout', compact('item'));
    }

    public function store(Request $request, $slug){

        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'city' => 'required',
            'address' => 'required',
            'zip' => 'required'
        ]) ;

        $start_date = Carbon::createFromFormat('d m Y', $request->start_date);
        $end_date = Carbon::createFromFormat('d m Y', $request->end_date);

        $days = $start_date->diffInDays($end_date);

        $item = Item::where('slug', $slug)->first();

        $total_price = $days * $item->price;

        $booking = $item->bookings()->create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'city' => $request->city,
            'address' => $request->address,
            'zip' => $request->zip,
            'total_price' => $total_price
        ]);


      return redirect()->route('front.payment', $booking->id);

      }


}
