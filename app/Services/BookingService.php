<?php

namespace App\Services;

use App\Repositories\BookingRepository;

class BookingService
{
    protected $repository;

    public function __construct(BookingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(array $data)
    {
        $data['status'] = 'pending'; // Default status
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
