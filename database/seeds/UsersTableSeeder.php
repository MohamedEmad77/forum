<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'admin',
            'email' => 'moh@admin.com',
            'password' => bcrypt('123456'),
            'avatar' => asset('avatars/avatar.png'),
            'admin' => 1
        ]);

        App\User::create([
            'name' => 'marym',
            'password' => bcrypt('123456'),
            'email' => 'mar@mar.com',
            'avatar' => asset('avatars/avatar.png')
        ]); 
    }
}
