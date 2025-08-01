<?php

namespace App\Repositories;

use App\Models\Booking;

class BookingRepository
{
    public function create(array $data)
    {
        return Booking::create($data);
    }

    public function isDuplicate($userId, $serviceId, $bookingDate)
    {
        return Booking::where('user_id', $userId)
            ->where('service_id', $serviceId)
            ->whereDate('booking_date', $bookingDate)
            ->exists();
    }

    public function getByUser($userId)
    {
        return Booking::with('service')
            ->where('user_id', $userId)
            ->get();
    }

    public function getAllWithRelations()
    {
        return Booking::with('user', 'service')->get();
    }

    public function findOrFail($id)
    {
        return Booking::findOrFail($id);
    }

    public function delete(Booking $booking)
    {
        return $booking->delete();
    }
}
