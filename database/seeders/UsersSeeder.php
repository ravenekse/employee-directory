<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    private Users $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $admin = $this->users->create([
            "email" => "admin@example.com",
            "password" => Hash::make("password"),
            "firstname" => "Adam",
            "surname" => "Nowak",
            "phone_number" => "+48123456789",
            "description" => "Jestem Administratorem tego systemu :)",
        ]);

        $admin->assignRole("admin");

        $user1 = $this->users
            ->create([
                "email" => "zbigniew@example.com",
                "password" => Hash::make("password"),
                "firstname" => "Zbigniew",
                "surname" => "Json",
                "phone_number" => "+48123456789",
                "description" =>
                    "Moją pasją jest sprzedawanie dziurawych dętek, dletego uwielbiam swoją pracę i stanowisko na którym pracuję.",
            ])
            ->assignRole("employee");

        $user2 = $this->users
            ->create([
                "email" => "jan@example.com",
                "password" => Hash::make("password"),
                "firstname" => "Jan",
                "surname" => "Kowalski",
                "phone_number" => "+48123456789",
                "description" =>
                    "Kontakt z klientem jest podstawą handlu. Ja mam dar przekonywania, dlatego pracuje na tym stanowisku.",
            ])
            ->assignRole("employee");

        $user1->departments()->attach(1);
        $user2->departments()->attach(2);
    }
}
