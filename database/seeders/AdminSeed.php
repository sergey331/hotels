<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Admin',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'phone' => '45858895',
            'email' => 'admin@admin.ru',
            'password' => Hash::make('111111111')
        ]);
    }
}
