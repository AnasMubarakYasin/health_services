<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Administrator;
use App\Models\Midwife;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        $administrator = Administrator::factory()->count(25)->create();
        $midwives = Midwife::factory()->count(25)->create();
        $patients = Patient::factory()->count(25)->create();

        Service::create(['name' => 'pemeriksaan kehamilan']);
        Service::create(['name' => 'perawatan bayi baru lahir']);
        Service::create(['name' => 'pelayanan kesehatan masa nifas']);
        Service::create(['name' => 'pelayanan KB']);
        Service::create(['name' => 'tindik telinga']);

        Schedule::factory()->count(50)->state(new Sequence(
            ...$midwives->map(function ($midwife) {
                return ['midwife_id' => $midwife->id];
            })->toArray()
        ))->state(new Sequence(
            [
                'started_at' => '08:00:00',
                'ended_at' => '12:00:00',
            ],
            [
                'started_at' => '13:00:00',
                'ended_at' => '16:00:00',
            ],
            [
                'started_at' => '18:00:00',
                'ended_at' => '20:00:00',
            ],
            [
                'started_at' => '08:00:00',
                'ended_at' => '16:00:00',
            ],
            [
                'started_at' => '13:00:00',
                'ended_at' => '20:00:00',
            ],
        ))->create();
    }
}
