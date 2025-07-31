<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\BookingService;
use Carbon\Carbon;

class BookingServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(BookingService::class);
    }

    public function test_it_creates_a_valid_booking()
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();

        $data = [
            'user_id' => $user->id,
            'service_id' => $service->id,
            'booking_date' => Carbon::tomorrow()->format('Y-m-d'),
        ];

        $booking = $this->service->store($data);

        $this->assertInstanceOf(Booking::class, $booking);
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'service_id' => $service->id,
            'booking_date' => $data['booking_date'],
        ]);
    }

    public function test_it_prevents_duplicate_booking()
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();

        $bookingDate = Carbon::tomorrow()->format('Y-m-d');

        // First booking
        Booking::create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'booking_date' => $bookingDate,
            'status' => 'pending',
        ]);

        // Attempt duplicate
        $data = [
            'user_id' => $user->id,
            'service_id' => $service->id,
            'booking_date' => $bookingDate,
        ];

        $result = $this->service->store($data);

        $this->assertIsArray($result);
        $this->assertEquals('You have already booked this service on this date.', $result['error']);
    }

    public function test_it_rejects_past_booking_date()
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();

        $response = $this->actingAs($user)->postJson(route('bookings.store'), [
            'service_id' => $service->id,
            'booking_date' => now()->subDay()->toDateString(),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['booking_date']);
    }
}
