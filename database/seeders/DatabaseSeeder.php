<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Package;
use App\Models\Recipient;
use App\Models\Sender;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ConnectRelationshipsSeeder::class);
        $this->call(UsersTableSeeder::class);

        Model::reguard();
        Status::create(['status' => 'Reported']);
        Status::create(['status' => 'Printed']);
        Status::create(['status' => 'Delivered to sorting center']);
        Status::create(['status' => 'Sorted']);
        Status::create(['status' => 'In transit']);
        Status::create(['status' => 'Delivered']);

        $address_1 = Address::create([
            'country' => 'The Netherlands',
            'city' => 'Amsterdam',
            'street' => 'Koelaan',
            'house_number' => 18,
            'addition' => 'A',
            'postal_code' => '5544KL'
        ]);
        $address_2 = Address::create([
            'country' => 'Brazil',
            'city' => 'Rio de janearo',
            'street' => 'Rue de rio',
            'house_number' => 23,
            'postal_code' => '55454KL'
        ]);
        $address_3 = Address::create([
            'country' => 'The Netherlands',
            'city' => 'Uden',
            'street' => 'Florijn',
            'house_number' => 11,
            'postal_code' => '5406BE'
        ]);

        $recipient_1 = Recipient::create([
            'first_name'=>'Jan',
            'middle_name'=>'',
            'last_name'=>'Pan',
            'email_address'=>'jan@pannetje.nl',
            'phone_number'=>'0638653289',
            'address_id' => $address_1->id
        ]);
        $recipient_2 = Recipient::create([
            'first_name'=>'Bart',
            'middle_name'=>'van',
            'last_name'=>'Tiel',
            'email_address'=>'bart@mail.nl',
            'phone_number'=>'0638653289',
            'address_id' => $address_3->id
        ]);

        $sender_1 = Sender::create([
            'name'=>'Rainforest Holdings',
            'address_id' => $address_2->id
        ]);

        $package_1 = Package::create([
            'sender_id' => $sender_1->id,
            'recipient_id'=>$recipient_1->id,
            'address_id' => $address_1->id,
            'status' => 'In transit',
            'sent_date' => '2022-03-02 11:28:22'
        ]);
        $package_2 = Package::create([
            'sender_id' => $sender_1->id,
            'recipient_id'=>$recipient_2->id,
            'address_id' => $address_1->id,
            'status' => 'Reported',
            'sent_date' => '2022-03-02 11:28:22'
        ]);
    }
}
