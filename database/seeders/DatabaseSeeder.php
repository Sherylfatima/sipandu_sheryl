<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dataNewAdmin =[
            'nik'            =>'123456789',
            'name'           =>'Admin',
            'jeniskelamin'   =>'Perempuan',
            'alamat'         =>'Langensari',
            'notelpon'       =>'08126363826',
            'role'           =>'Admin',
            'email'          =>'admin@gmail.com',
            'password'       =>bcrypt('12345')
        ];
        User::create($dataNewAdmin);

    }
}
