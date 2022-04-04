<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Role Types
         *
         */
        $RoleItems = [
            [
                'name'        => 'Super admin',
                'slug'        => 'superadmin',
                'description' => 'The super admin',
                'level'       => 5,
            ],
            [
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 4,
            ],
            [
                'name'        => 'Packer',
                'slug'        => 'packer',
                'description' => 'An employee who packs orders',
                'level'       => 3,
            ],
            [
                'name'        => 'Web shop',
                'slug'        => 'webshop',
                'description' => 'A webshop',
                'level'       => 2,
            ],
            [
                'name'        => 'Customer',
                'slug'        => 'customer',
                'description' => 'A logged in customer',
                'level'       => 1,
            ],
            [
                'name'        => 'Guest',
                'slug'        => 'guest',
                'description' => 'A customer who is not logged in',
                'level'       => 0,
            ],
        ];

        /*
         * Add Role Items
         *
         */
        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $RoleItem['slug'])->first();
            if ($newRoleItem === null) {
                $newRoleItem = config('roles.models.role')::create([
                    'name'          => $RoleItem['name'],
                    'slug'          => $RoleItem['slug'],
                    'description'   => $RoleItem['description'],
                    'level'         => $RoleItem['level'],
                ]);
            }
        }
    }
}
