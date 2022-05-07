<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userPassword = '12345678';

        User::factory()->create([
            'username' => 'admin',
            'user_role' => 'admin',
            'password' => Hash::make($userPassword)
        ]);

        User::factory()->create([
            'username' => 'client',
            'user_role' => 'client',
            'password' => Hash::make($userPassword)
        ]);
    }
}
