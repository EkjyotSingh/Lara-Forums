<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'role'=>'admin',
            'password'=>Hash::make('11111111'),
            

        ]);
        User::create([
            'name'=>'ekjyot',
            'email'=>'ekjyotphp@gmail.com',
            'password'=>Hash::make('11111111'),
            'role'=>'writer',
            
        ]);
    }
}
