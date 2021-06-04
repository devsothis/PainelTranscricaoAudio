<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'André Lengruber',
            'email' => 'alengruber@sothis.com.br',
            'password' => Hash::make(123456)
        ]);
    }
}
