<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.adm',
                'password' => Hash::make('12345678')
            ],
            [
                'name' => 'user',
                'email' => 'user@user.usr',
                'password' => Hash::make('87654321')
            ],
        ];

        DB::table('users')->insert($data);
    }
}
