<?php

namespace Database\Seeders;

use App\Models\Bab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tingkats = ['1', '2', '3', '4', '5', '6'];
        for ($t = 0; $t < 6; $t++) {
            for ($b = 0; $b < 10; $b++) {
                Bab::create([
                    'tingkat' => $tingkats[$t],
                    'label' => 'Bab ' . $b + 1,
                    'deskripsi' => 'Bab ' . $b + 1 . ' Kelas ' . $t
                ]);
            }
        }
    }
}
