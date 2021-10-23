<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->delete();

        $users = [
            [
                'name' => 'SuperAdmin',
                'email' => 'SuperAdmin @gmail.com',
                'password' => Hash::make(12345678),
                'isAdmin' => 1,
            ],
            [
                'name' => 'Admin',
                'email' => 'Admin @gmail.com',
                'password' => Hash::make(12345678),
                'isAdmin' => 0,
            ],
            [
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make(12345678),
                'isAdmin' => 0,
            ],
        ];

        User::insert($users);
    }
}
