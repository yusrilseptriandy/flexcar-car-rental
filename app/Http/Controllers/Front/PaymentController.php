<?php

namespace App\Http\Controllers\Front;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index(Request $request, $bookingId)
    {
        $booking = Booking::with(['item.brand', 'item.type'])->findOrFail($bookingId);

        return view('payment', [
            'booking' => $booking
        ]);
    }

    public function detail(Request $request, $bookingId)
    {
        $booking = Booking::with(['item.brand', 'item.type'])->findOrFail($bookingId);

        return view('payment-detail', [
            'booking' => $booking
        ]);
    }

    public function update(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->payment_method = $request->payment_method;

        $booking->save();

        return redirect()->route('front.payment.success');
    }

    public function success(Request $request)
    {
        return view('success');
    }
}