<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->insert([
            [
                'id' => '1',
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => Role::ADMIN
            ],
            [
                'id' => '2',
                'name' => 'Renata',
                'email' => 'renata@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('renata123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => Role::STUDENT
            ],
            [
                'id' => '3',
                'name' => 'Barisic',
                'email' => 'barisic@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('barisic123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => Role::STUDENT
            ],
            [
                'id' => '4',
                'name' => 'Student',
                'email' => 'student@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('student123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => Role::STUDENT
            ],
            [
                'id' => '5',
                'name' => 'Profesor',
                'email' => 'profesor@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('profesor123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => Role::TEACHER
            ],

        ]);
    }
}
