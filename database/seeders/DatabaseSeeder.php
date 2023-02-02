<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $user = \App\Models\Users::create([
            "email" => "ravenekse@example.com",
            "password" => Hash::make("password"),
            "firstname" => "Adam",
            "surname" => "Tyryłło",
            "phone_number" => "+48123456789",
        ]);

        $department = \App\Models\Departments::create([
            "name" => "Dział handlowy",
            "description" => "Tutaj się sprzedaje dziurawe dętki"
        ]);

        $user->departments()->attach($department);
    }
}
