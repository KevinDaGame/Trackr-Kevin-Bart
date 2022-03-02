<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'name' => 'Bart van Tiel',
            'email' => 'bart@mail.com',
            'phoneNumber' => '06-12345678',
            'address_id' => 1
        ]);

        Customer::create([
            'name' => 'Avans Den Bosch',
            'email' => 'info@avans.com',
            'phoneNumber' => '06-12345678',
            'address_id' => 2
        ]);
    }
}
