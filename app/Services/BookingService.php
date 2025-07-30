<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use Carbon\Carbon;

class BookingService
{
    protected $repository;

    public function __construct(BookingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(array $data)
    {
        // Check for duplicate booking (same user, service, date)
        if ($this->repository->isDuplicate(
            $data['user_id'],
            $data['service_id'],
            $data['booking_date']
        )) {
            return ['error' => 'You have already booked this service on this date.'];
        }

        // Set default status
        $data['status'] = 'pending';

        // Create and return booking
        return $this->repository->create($data);
    }


    public function getUserBookings($userId)
    {
        return $this->repository->getByUser($userId);
    }

    public function getAllBookings()
    {
        return $this->repository->getAllWithRelations();
    }

    public function find($id)
    {
        return $this->repository->findOrFail($id);
    }

    public function destroy($booking)
    {
        return $this->repository->delete($booking);
    }
}
