<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customerRole = config('roles.models.role')::where('name', '=', 'Customer')->first();
        $webshopRole = config('roles.models.role')::where('name', '=', 'Web shop')->first();
        $packerRole = config('roles.models.role')::where('name', '=', 'Packer')->first();
        $superAdminRole = config('roles.models.role')::where('name', '=', 'Super admin')->first();
        $adminRole = config('roles.models.role')::where('name', '=', 'Admin')->first();
        $permissions = config('roles.models.permission')::all();

        /*
         * Add Users
         *
         */
        if (config('roles.models.defaultUser')::where('email', '=', 'superadmin@trackr.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Super admin',
                'email'    => 'superadmin@trackr.com',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($superAdminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'admin@trackr.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Admin',
                'email'    => 'admin@trackr.com',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($adminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'packer@trackr.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Packer',
                'email'    => 'packer@trackr.com',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($packerRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'webshop@trackr.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Webshop',
                'email'    => 'webshop@trackr.com',
                'sender_id' => 1,
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($webshopRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'customer@trackr.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Customer',
                'email'    => 'customer@trackr.com',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($customerRole);
        }
    }
}
