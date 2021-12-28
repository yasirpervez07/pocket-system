<?php

use App\User;
use Illuminate\Database\Seeder;
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
        User::insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'phone' => Str::random(11),
            'image' => Str::random(10),
            'password' => Hash::make('password'),
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
    }
}
