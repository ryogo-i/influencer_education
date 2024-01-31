<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'テストユーザー',
            'name_kana' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'profile_image' => 'no image',
            'now_class' => '3',
        ]);
    }
}
