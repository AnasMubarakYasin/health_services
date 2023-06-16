<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Administrator;
use App\Models\Midwife;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $administrator = Administrator::factory()->create([
            'name' => 'admin',
            'password' => 'admin',
        ]);
        $midwife = Midwife::factory()->create([
            'name' => 'midwife',
            'password' => 'midwife',
        ]);
        $patient = Patient::factory()->create([
            'name' => 'patient',
            'password' => 'patient',
        ]);
        $administrator = Administrator::factory()->count(100)->create();
        $midwives = Midwife::factory()->count(100)->create();
        $patients = Patient::factory()->count(100)->create();
    }
}
