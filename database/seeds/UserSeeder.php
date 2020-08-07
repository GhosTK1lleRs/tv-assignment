<?php

use App\User;
use Illuminate\Database\Seeder;

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
            'name'=>'admin',
            'email' => 'admin@email.com',
            'password'=>bcrypt('admin')
        ]);
        User::insert([
            'name'=>'user',
            'email' => 'user@email.com',
            'password'=>bcrypt('user')
        ]);
        User::insert([
            'name'=>'user1',
            'email' => 'user1@email.com',
            'password'=>bcrypt('123456')
        ]);
        User::insert([
            'name'=>'user2',
            'email' => 'user2@email.com',
            'password'=>bcrypt('123456')
        ]);
    }
}
