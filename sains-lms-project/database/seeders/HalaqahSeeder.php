<?php

namespace Database\Seeders;

use App\Models\Halaqah;
use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HalaqahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodis = Prodi::all();

        foreach ($prodis as $prodi) {
            for ($i = 1; $i <= 4; $i++) {
                $halaqahCode = sprintf('%s-%02d', $prodi->prodi_code, $i);
                $halaqahName = "{$prodi->prodi_name} {$i}";
                $halaqahType = $i <= 2 ? 'Halaqah Ikhwan' : 'Halaqah Akhwat';

                Halaqah::create([
                    'halaqah_code' => $halaqahCode,
                    'halaqah_name' => $halaqahName,
                    'halaqah_type' => $halaqahType,
                    'prodi_id' => $prodi->id,
                ]);
            }
        }
    }
}
