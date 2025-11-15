<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodies = [
            ['prodi_code' => 'A01', 'prodi_name' => 'Ekonomi Pembangunan'],
            ['prodi_code' => 'A02', 'prodi_name' => 'Manajemen'],
            ['prodi_code' => 'A03', 'prodi_name' => 'Akuntansi'],
            ['prodi_code' => 'B01', 'prodi_name' => 'Ilmu Hukum'],
            ['prodi_code' => 'B02', 'prodi_name' => 'Hukum Administrasi Negara'],
            ['prodi_code' => 'C01', 'prodi_name' => 'Pendidikan Dokter'],
            ['prodi_code' => 'C02', 'prodi_name' => 'Psikologi'],
            ['prodi_code' => 'C03', 'prodi_name' => 'Kedokteran Hewan'],
            ['prodi_code' => 'D01', 'prodi_name' => 'Teknik Sipil'],
            ['prodi_code' => 'D02', 'prodi_name' => 'Teknik Mesin'],
            ['prodi_code' => 'D03', 'prodi_name' => 'Teknik Perkapalan'],
            ['prodi_code' => 'D04', 'prodi_name' => 'Teknik Elektro'],
            ['prodi_code' => 'D05', 'prodi_name' => 'Arsitektur'],
            ['prodi_code' => 'D06', 'prodi_name' => 'Teknik Geologi'],
            ['prodi_code' => 'D07', 'prodi_name' => 'Teknik Industri'],
            ['prodi_code' => 'D08', 'prodi_name' => 'Teknik Kelautan'],
            ['prodi_code' => 'D09', 'prodi_name' => 'Teknik Sistem Perkapalan'],
            ['prodi_code' => 'D10', 'prodi_name' => 'Teknik Perencanaan Wilayah dan Kota'],
            ['prodi_code' => 'D11', 'prodi_name' => 'Teknik Pertambangan'],
            ['prodi_code' => 'D12', 'prodi_name' => 'Teknik Informatika'],
            ['prodi_code' => 'D13', 'prodi_name' => 'Teknik Lingkungan'],
            ['prodi_code' => 'D14', 'prodi_name' => 'Teknik Metalrugi dan Material'],
            ['prodi_code' => 'D15', 'prodi_name' => 'Teknik Geodesi'],
            ['prodi_code' => 'E01', 'prodi_name' => 'Administrasi Publik'],
            ['prodi_code' => 'E02', 'prodi_name' => 'Ilmu Komunikasi'],
            ['prodi_code' => 'E03', 'prodi_name' => 'Sosiologi'],
            ['prodi_code' => 'E04', 'prodi_name' => 'Ilmu Politik'],
            ['prodi_code' => 'E05', 'prodi_name' => 'Ilmu Pemerintahan'],
            ['prodi_code' => 'E06', 'prodi_name' => 'Ilmu Hubungan Internasional'],
            ['prodi_code' => 'E07', 'prodi_name' => 'Antropologi'],
            ['prodi_code' => 'F01', 'prodi_name' => 'Sastra Indonesia'],
            ['prodi_code' => 'F02', 'prodi_name' => 'Sastra Daerah'],
            ['prodi_code' => 'F03', 'prodi_name' => 'Sastra Arab'],
            ['prodi_code' => 'F04', 'prodi_name' => 'Sastra Inggris'],
            ['prodi_code' => 'F05', 'prodi_name' => 'Sastra Perancis'],
            ['prodi_code' => 'F06', 'prodi_name' => 'Ilmu Sejarah'],
            ['prodi_code' => 'F07', 'prodi_name' => 'Arkeologi'],
            ['prodi_code' => 'F08', 'prodi_name' => 'Sastra Jepang'],
            ['prodi_code' => 'F09', 'prodi_name' => 'Bahasa Mandarin dan Kebudayaan Tiongkok'],
            ['prodi_code' => 'F10', 'prodi_name' => 'Pariwisata'],
            ['prodi_code' => 'G01', 'prodi_name' => 'Agroteknologi'],
            ['prodi_code' => 'G02', 'prodi_name' => 'Agribisnis'],
            ['prodi_code' => 'G03', 'prodi_name' => 'Ilmu dan Teknologi Pangan'],
            ['prodi_code' => 'G04', 'prodi_name' => 'Teknik Pertanian'],
            ['prodi_code' => 'G05', 'prodi_name' => 'Ilmu Tanah'],
            ['prodi_code' => 'G06', 'prodi_name' => 'Proteksi Tanaman'],
            ['prodi_code' => 'G07', 'prodi_name' => 'Teknologi Industri Pertanian'],
            ['prodi_code' => 'H01', 'prodi_name' => 'Matematika'],
            ['prodi_code' => 'H02', 'prodi_name' => 'Fisika'],
            ['prodi_code' => 'H03', 'prodi_name' => 'Kimia'],
            ['prodi_code' => 'H04', 'prodi_name' => 'Biologi'],
            ['prodi_code' => 'H05', 'prodi_name' => 'Statistika'],
            ['prodi_code' => 'H06', 'prodi_name' => 'Geofisika'],
            ['prodi_code' => 'H07', 'prodi_name' => 'Sistem Informasi'],
            ['prodi_code' => 'H08', 'prodi_name' => 'Ilmu Aktuaria'],
            ['prodi_code' => 'I01', 'prodi_name' => 'Peternakan'],
            ['prodi_code' => 'J01', 'prodi_name' => 'Pendidikan Dokter Gigi'],
            ['prodi_code' => 'K01', 'prodi_name' => 'Kesehatan Masyarakat'],
            ['prodi_code' => 'K02', 'prodi_name' => 'Ilmu Gizi'],
            ['prodi_code' => 'L01', 'prodi_name' => 'Ilmu Kelautan'],
            ['prodi_code' => 'L02', 'prodi_name' => 'Manajemen Sumber Daya Perairan'],
            ['prodi_code' => 'L03', 'prodi_name' => 'Budidaya Perairan'],
            ['prodi_code' => 'L04', 'prodi_name' => 'Agrobisnis Perikanan'],
            ['prodi_code' => 'L05', 'prodi_name' => 'Pemanfaatan Sumber Daya Perikanan'],
            ['prodi_code' => 'L06', 'prodi_name' => 'Teknologi Hasil Perikanan'],
            ['prodi_code' => 'M01', 'prodi_name' => 'Kehutanan'],
            ['prodi_code' => 'M02', 'prodi_name' => 'Rekayasa Kehutanan'],
            ['prodi_code' => 'M03', 'prodi_name' => 'Konservasi Hutan'],
            ['prodi_code' => 'N01', 'prodi_name' => 'Farmasi'],
            ['prodi_code' => 'R01', 'prodi_name' => 'Ilmu Keperawatan'],
            ['prodi_code' => 'R02', 'prodi_name' => 'Fisioterapi'],
        ];

        foreach ($prodies as $prodi) {

            $facultyCode = substr($prodi['prodi_code'], 0, 1);
            $faculty = Faculty::where('faculty_code', $facultyCode)->first();
            Prodi::create([
                'prodi_code' => $prodi['prodi_code'],
                'prodi_name' => $prodi['prodi_name'],
                'faculty_id' => $faculty ? $faculty->id : null,
            ]);
        }
    }
}
