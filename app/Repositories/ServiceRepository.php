<?php

namespace App\Repositories;

use App\Models\Service;

class ServiceRepository
{
    public function allActive()
    {
        return Service::where('status', true)->get();
    }

    public function existsByName(string $name): bool
    {
        return Service::where('name', $name)->exists();
    }

    public function create(array $data)
    {
        return Service::create($data);
    }

    public function update(Service $service, array $data)
    {
        $service->update($data);
        return $service;
    }

    public function delete(Service $service)
    {
        return $service->delete();
    }

    public function findOrFail($id)
    {
        return Service::findOrFail($id);
    }
}
