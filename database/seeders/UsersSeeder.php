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
            "password" => Hash::make("password1234"),
            "firstname" => "Adam",
            "surname" => "Nowak",
            "phone_number" => "+48123456789",
        ]);

        $admin->assignRole("admin");

        $user1 = $this->users
            ->create([
                "email" => "ravenekse@example.com",
                "password" => Hash::make("password12"),
                "firstname" => "Zbigniew",
                "surname" => "Json",
                "phone_number" => "+48123456789",
                "description" =>
                    "Moją pasją jest sprzedawanie dziurawych dętek, dletego uwielbiam swoją pracę i stanowisko na którym pracuję.",
            ])
            ->assignRole("employee");

        $user2 = $this->users
            ->create([
                "email" => "demo@example.com",
                "password" => Hash::make("password12"),
                "firstname" => "Jan",
                "surname" => "Kowalski",
                "phone_number" => "+48123456789",
                "description" =>
                    "Sprzedaż klocków hamulcowych to najprostsza rzecz na świecie. Ale każdy znajdzie coś dla siebie w naszej firmie",
            ])
            ->assignRole("employee");

        $user1->departments()->attach(1);
        $user2->departments()->attach(2);
    }
}
