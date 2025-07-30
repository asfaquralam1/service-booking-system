<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Services\BookingService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected $booking;

    public function __construct(BookingService $booking)
    {
        $this->booking = $booking;
    }


    public function store(BookingRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        try {
            $bookingDate = Carbon::createFromFormat('Y-m-d', $data['booking_date']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid date format.'], 422);
        }

        if ($bookingDate->isBefore(Carbon::today())) {
            return response()->json([
                'message' => 'You cannot book a service in the past.',
                'booking_date' => $bookingDate->toDateString(),
                'today' => Carbon::today()->toDateString(),
            ], 422);
        }

        $created = $this->booking->store($data);

        if (isset($created['error'])) {
            return response()->json(['message' => $created['error']], 409);
        }

        return response()->json($created, 201);
    }




    public function userBookings()
    {
        return response()->json($this->booking->getUserBookings(Auth::id()));
    }

    public function allBookings()
    {
        return response()->json($this->booking->getAllBookings());
    }

    public function destroy($id)
    {
        $booking = $this->booking->find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found.'], 404);
        }
        $this->booking->destroy($booking);

        return response()->json([
            'message' => 'Booking deleted successfully.'
        ]);
    }
}
