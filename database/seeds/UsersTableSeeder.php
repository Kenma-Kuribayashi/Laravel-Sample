<?php

use Illuminate\Database\Seeder;
 
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
 
        App\Eloquent\User::create([
            'name' => 'root',
            'email' => 'root@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}