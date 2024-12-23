<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $query  = Booking::with('item.brand', 'user');

            return DataTables::of($query)

                ->addColumn('action', function ($bookings) {
                    return '
                       <div class="flex w-full gap-2">
                        <a class = "focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900" href = "'. route('bookings.edit', $bookings->id) .'" >Edit</a>
                        </a>    


                            <form class = "block w-full" action = "'. route('bookings.destroy', $bookings->id) .'" method = "POST">
                                <button 
                                type="button" 
                                onclick="deleteBrand(\''. route('bookings.destroy', $bookings->id) .'\')" 
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete
                                </button>

                                ' . method_field('delete') . csrf_field() . '
                                </form>
                    
                        
                        <a class = "focus:outline-none hover:text-green-800 rounded text-sm px-5 py-2.5 me-2 mb-2 text-green-600 font-extrabold" href = "'. route('bookings.show', $bookings->id) .'" >Details</a>
                        </a>   

                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make();

        }

        return view('admin.bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        
        return view('admin.bookings.details', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {

        if (Auth::check() == false) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'status' => 'required |string|in:PENDING,SUCCESS,CANCEL',
        ]);

        

        $booking->update($data);

        return redirect()->route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index');
    }

    public function myOrders()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('item')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('my-orders', compact('bookings'));
    }
}


