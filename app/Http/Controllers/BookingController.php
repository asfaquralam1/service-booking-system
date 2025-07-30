<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(BookingRequest $request){
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'booking_date' => $request->booking_date,
            'status' => 'pending',
        ]);

        return response()->json($booking,201);
    }

    public function userBookings(){
        return response()->json(Auth::user()->bookings);
    }

    public function allBookings()  {
        return response()->json(Booking::with('user','service')->get());
    }
}
