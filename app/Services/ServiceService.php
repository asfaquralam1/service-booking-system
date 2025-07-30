<?php

namespace App\Services;

use App\Models\Service;
use App\Repositories\ServiceRepository;

class ServiceService
{
    protected $repository;

    public function __construct(ServiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllActive()
    {
        return $this->repository->allActive();
    }

    public function store(array $data)
    {
        if ($this->repository->existsByName($data['name'])) {
            throw new \Exception('A service with this name already exists.');
        }
        return $this->repository->create($data);
    }

    public function update(Service $service, array $data)
    {
        return $this->repository->update($service, $data);
    }

    public function destroy(Service $service)
    {
        return $this->repository->delete($service);
    }

    public function find($id)
    {
        return $this->repository->findOrFail($id);
    }
}
