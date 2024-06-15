<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Fathima_8260",
            'email' => 'fathima_hanaan-fh@ulster.ac.uk',
            'password' => Hash::make('password1234'),
            'email_verified_at' => now(),
        ]);
        User::factory()->count(2)->create();
    }
}

