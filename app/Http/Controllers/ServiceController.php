<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Services\ServiceService;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    protected $service;
    public function __construct(ServiceService $service)
    {
        $this->service = $service;
    }
    public function index(): JsonResponse
    {
        $services = $this->service->getAllActive();
        return response()->json($services);
    }

    public function store(ServiceRequest $request): JsonResponse
    {
        $service = $this->service->store($request->validated());;
        return response()->json($service, 201);
    }

    public function update(ServiceRequest $request, $id): JsonResponse
    {
        $service = $this->service->find($id);
        $updated = $service->update($request->validated());
        return response()->json($updated);
    }

    public function destroy($id): JsonResponse
    {
        $service = $this->service->find($id);
        $this->service->destroy($service);

        return response()->json(['message' => 'Service deleted successfully.']);
    }
}
