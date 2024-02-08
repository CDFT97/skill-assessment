<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin1234'),
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN
        ]);

        // USers
        for ($i=0; $i < 3; $i++) { 
            User::create([
                'name' => "User $i",
                'email' => "user$i@user.com",
                'password' => bcrypt('12345678'),
                'email_verified_at' => now(),
                'role' => User::ROLE_USER
            ]);
        }
    }
}
