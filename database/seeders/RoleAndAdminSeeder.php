<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RoleAndAdminSeeder extends Seeder
{
    public function run()
    {
        // Define roles
        $roles = [
            ['name' => 'admin'],
            ['name' => 'staff'],
            ['name' => 'cashier'],
        ];

        // Insert roles into the roles table
        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role['name']],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        // Get role IDs
        $roleAdmin = DB::table('roles')->where('name', 'admin')->value('id');
        $roleStaff = DB::table('roles')->where('name', 'staff')->value('id');
        $roleCashier = DB::table('roles')->where('name', 'cashier')->value('id');

        // Define users
        $admins = [
            [
                'name' => 'Kaung Admin',
                'email' => 'kaung@gmail.com',
                'password' => Hash::make('password123'),
                'role_id' => $roleAdmin,
            ],
            [
                'name' => 'Staff User',
                'email' => 'staff@example.com',
                'password' => Hash::make('password123'),
                'role_id' => $roleStaff,
            ],
            [
                'name' => 'Cashier User',
                'email' => 'cashier@example.com',
                'password' => Hash::make('password123'),
                'role_id' => $roleCashier,
            ],
        ];

        // Insert users into the users table
        foreach ($admins as $admin) {
            DB::table('admins')->updateOrInsert(
                ['email' => $admin['email']], // Check by email to avoid duplicates
                [
                    'name' => $admin['name'],
                    'password' => $admin['password'],
                    'role_id' => $admin['role_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
