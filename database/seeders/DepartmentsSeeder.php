<?php

namespace Database\Seeders;

use App\Models\Departments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    private Departments $departments;

    public function __construct(Departments $departments)
    {
        $this->departments = $departments;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->departments->create([
            "name" => "Dział handlowy",
            "description" => "Tutaj się sprzedaje dziurawe dętki",
        ]);

        $this->departments->create([
            "name" => "Dział klienta",
            "description" => "Kontakt z klientem to podstawa",
        ]);
    }
}
