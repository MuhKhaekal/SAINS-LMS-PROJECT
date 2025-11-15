<?php

namespace Database\Seeders;

use App\Models\ClassPai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassPaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classPais = [
            ['class_name' => 'PAI 1', 'lecturer' => 'Dr. Ahmad Syafii, M.Ag'],
            ['class_name' => 'PAI 2', 'lecturer' => 'Ust. Hasyim Anwar, Lc., M.A.'],
            ['class_name' => 'PAI 3', 'lecturer' => 'Dr. Nur Aini, M.Pd.I'],
            ['class_name' => 'PAI 4', 'lecturer' => 'Prof. H. Muhammad Ridwan, Ph.D.'],
            ['class_name' => 'PAI 5', 'lecturer' => 'Ust. Farhan Al-Banna, M.A.'],
            ['class_name' => 'PAI 6', 'lecturer' => 'Dr. Siti Rahmawati, M.Ag'],
            ['class_name' => 'PAI 7', 'lecturer' => 'Ust. Yusuf Maulana, Lc.'],
            ['class_name' => 'PAI 8', 'lecturer' => 'Dr. H. Abdul Karim, M.Pd.I'],
            ['class_name' => 'PAI 9', 'lecturer' => 'Ust. Ahmad Fadhil, M.A.'],
            ['class_name' => 'PAI 10', 'lecturer' => 'Dr. Hj. Nurul Aisyah, M.Pd.I'],
            ['class_name' => 'PAI 11', 'lecturer' => 'Prof. Dr. H. Zainuddin, M.Ag'],
            ['class_name' => 'PAI 12', 'lecturer' => 'Ust. Miftahul Jannah, Lc.'],
            ['class_name' => 'PAI 13', 'lecturer' => 'Dr. Hasan Basri, M.Pd.I'],
            ['class_name' => 'PAI 14', 'lecturer' => 'Ust. Riza Kurniawan, M.A.'],
            ['class_name' => 'PAI 15', 'lecturer' => 'Dr. Sri Wahyuni, M.Pd.I'],
            ['class_name' => 'PAI 16', 'lecturer' => 'Ust. Habib Rahman, Lc., M.A.'],
            ['class_name' => 'PAI 17', 'lecturer' => 'Dr. H. Abdul Malik, M.Ag'],
            ['class_name' => 'PAI 18', 'lecturer' => 'Ust. Zaki Maulana, M.Pd.I'],
            ['class_name' => 'PAI 19', 'lecturer' => 'Dr. Rahmat Hidayat, M.Ag'],
            ['class_name' => 'PAI 20', 'lecturer' => 'Ust. Nabil Fadlan, Lc.'],
            ['class_name' => 'PAI 21', 'lecturer' => 'Dr. Hj. Rukayah, M.Pd.I'],
            ['class_name' => 'PAI 22', 'lecturer' => 'Ust. Muhammad Fikri, Lc., M.A.'],
            ['class_name' => 'PAI 23', 'lecturer' => 'Dr. Hanifah Salsabila, M.Pd.I'],
            ['class_name' => 'PAI 24', 'lecturer' => 'Ust. Ahmad Zubair, Lc.'],
            ['class_name' => 'PAI 25', 'lecturer' => 'Dr. Arifin Hidayat, M.Ag'],
            ['class_name' => 'PAI 26', 'lecturer' => 'Ust. Fauzan Rizqi, M.Pd.I'],
            ['class_name' => 'PAI 27', 'lecturer' => 'Dr. Hj. Aulia Rahman, M.A.'],
            ['class_name' => 'PAI 28', 'lecturer' => 'Ust. Salman Yusuf, Lc.'],
            ['class_name' => 'PAI 29', 'lecturer' => 'Dr. H. Bahruddin, M.Pd.I'],
            ['class_name' => 'PAI 30', 'lecturer' => 'Ust. Rifqi Ramadhan, Lc., M.A.'],
        ];

        foreach ($classPais as $classPai) {
            ClassPai::create([
                'class_name' => $classPai['class_name'],
                'lecturer' => $classPai['lecturer'],
            ]);
        }
        
    }
}
