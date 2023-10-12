<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'          => 'admin',
                'email'         => 'admin@admin.com',
                'role'          => 'admin',
                'password'      => Hash::make('admin'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'approval',
                'email'         => 'approval@approval.com',
                'role'          => 'approval',
                'password'      => Hash::make('approval'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}