<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $services = [
            ['name' => 'AC Repair', 'description' => 'Air Conditioner servicing and repair', 'price' => 1500],
            ['name' => 'Plumbing', 'description' => 'Fixing leaks and pipe fittings', 'price' => 1000],
            ['name' => 'Electrician', 'description' => 'Electrical maintenance and wiring', 'price' => 1200],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
