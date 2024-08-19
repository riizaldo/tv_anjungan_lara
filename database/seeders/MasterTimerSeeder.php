<?php

namespace Database\Seeders;

use App\Models\MasterTimer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterTimerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['frame3', 'frame1', 'frame2', 'footer'];
        $jenis = ['13', '13', '13', '13'];

        foreach ($roles as $index => $role) {
            $newRole =
                MasterTimer::create([
                    'tipe' => $role,
                    'timer' => $jenis[$index]
                ]);
        }
    }
}
