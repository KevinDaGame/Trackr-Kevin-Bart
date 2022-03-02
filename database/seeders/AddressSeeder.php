<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
            'street' => 'Florijn',
            'houseNumber' => 11,
            'city' => 'Uden',
            'postalCode' => '5406BE',
            'country' => 'Nederland'
        ]);

        Address::create([
            'street' => 'Onderwijsboulevard',
            'houseNumber' => 215,
            'city' => 'Den Bosch',
            'postalCode' => '5006BE',
            'country' => 'Nederland'
        ]);
    }
}
