<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
 
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        (new User())->newQuery()->insert([
            [
                'name' => 'test-user',
                'email' => 'a@sample.com',
                'password' => Hash::make('password'), 
                'is_contributor' => 1, 
                'created_at' => $now, 
                'updated_at' => $now, 
            ]
        ]);
    }
}