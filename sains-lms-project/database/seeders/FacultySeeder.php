<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = [
            ['faculty_code' => 'A', 'faculty_name' => 'Fakultas Ekonomi dan Bisnis'],
            ['faculty_code' => 'B', 'faculty_name' => 'Fakultas Hukum'],
            ['faculty_code' => 'C', 'faculty_name' => 'Fakultas Kedokteran'],
            ['faculty_code' => 'D', 'faculty_name' => 'Fakultas Teknik'],
            ['faculty_code' => 'E', 'faculty_name' => 'Fakultas Ilmu Sosial dan Ilmu Politik'],
            ['faculty_code' => 'F', 'faculty_name' => 'Fakultas Ilmu Budaya'],
            ['faculty_code' => 'G', 'faculty_name' => 'Fakultas Pertanian'],
            ['faculty_code' => 'H', 'faculty_name' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam'],
            ['faculty_code' => 'I', 'faculty_name' => 'Fakultas Peternakan'],
            ['faculty_code' => 'J', 'faculty_name' => 'Fakultas Kedokteran Gigi'],
            ['faculty_code' => 'K', 'faculty_name' => 'Fakultas Kesehatan Masyarakat'],
            ['faculty_code' => 'L', 'faculty_name' => 'Fakultas Ilmu Kelautan dan Perikanan'],
            ['faculty_code' => 'M', 'faculty_name' => 'Fakultas Kehutanan'],
            ['faculty_code' => 'N', 'faculty_name' => 'Fakultas Farmasi'],
            ['faculty_code' => 'R', 'faculty_name' => 'Fakultas Keperawatan'],
            ['faculty_code' => 'V', 'faculty_name' => 'Fakultas Vokasi'],
        ];

        foreach ($faculties as $faculty) {
            Faculty::create([
                'faculty_code' => $faculty['faculty_code'],
                'faculty_name' => $faculty['faculty_name']
            ]);
        }

    }
}
