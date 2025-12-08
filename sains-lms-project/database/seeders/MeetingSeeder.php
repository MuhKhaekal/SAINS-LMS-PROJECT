<?php

namespace Database\Seeders;

use App\Models\Meeting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meetings = [
            [
                'meeting_name' => 'Pre Test',
                'topic' => 'Pre Test Pemahaman Al-Qur’an',
                'description' => 'Tes awal untuk mengetahui tingkat pemahaman peserta terkait bahan ajar SAINS.',
                'type' => 'pretest'
            ],
        
            [
                'meeting_name' => 'Kelas Besar',
                'topic' => 'Pra-SAINS',
                'description' => 'Praktikan dikumpulkan untuk membahas berbagai kelengkapan sebelum SAINS dimulai',
                'type' => 'skb'
            ],
            [
                'meeting_name' => 'Pertemuan 1',
                'topic' => 'Pengenalan Program SAINS',
                'description' => 'Pemaparan tujuan, metode belajar, dan aturan pelaksanaan Studi Al-Qur’an Intensif Unhas.',
                'type' => 'skk'
            ],
            [
                'meeting_name' => 'Pertemuan 2',
                'topic' => 'Adab Membaca dan Menghafal Al-Qur’an',
                'description' => 'Pembahasan adab dan etika dalam membaca serta menghafal Al-Qur’an berdasarkan sunnah.',
                'type' => 'skk'
            ],
            [
                'meeting_name' => 'Pertemuan 3',
                'topic' => 'Pengenalan Tajwid Dasar',
                'description' => 'Pengenalan makharijul huruf, sifat huruf, dan hukum-hukum bacaan tajwid dasar.',
                'type' => 'skk'
            ],
            [
                'meeting_name' => 'Pertemuan 4',
                'topic' => 'Hukum Bacaan Nun Mati & Mim Mati',
                'description' => 'Materi lanjutan seputar idgham, ikhfa’, iqlab, dan hukum mim sukun.',
                'type' => 'skk'
            ],
            [
                'meeting_name' => 'Pertemuan 5',
                'topic' => 'Tajwid Tingkat Lanjut',
                'description' => 'Mempelajari hukum-hukum lanjutan seperti mad, ghunnah, dan waqaf-ibtida‘.',
                'type' => 'skk'
            ],
            [
                'meeting_name' => 'Pertemuan 6',
                'topic' => 'Praktik Tilawah dan Evaluasi Akhir',
                'description' => 'Sesi praktik membaca Al-Qur’an dan evaluasi perkembangan peserta.',
                'type' => 'skk'
            ],
        
            [
                'meeting_name' => 'Post Test',
                'topic' => 'Post Test Pemahaman Al-Qur’an',
                'description' => 'Tes akhir untuk mengukur peningkatan pemahaman dan bacaan peserta setelah mengikuti program.',
                'type' => 'posttest'
            ],
            [
                'meeting_name' => 'Ujian Akhir',
                'topic' => 'Ujian Akhir SAINS',
                'description' => 'Sebagai tes materi penutup untuk mengukur sejauh mana pengetahuan.',
                'type' => 'ujian'
            ],
            [
                'meeting_name' => 'Ramah Tamah',
                'topic' => 'Penutupan SAINS',
                'description' => 'Penutupan SAINS yang dilakukan dan pemberian sertifikat sebagai bukti telah mengikuti SAINS',
                'type' => 'ramah-tamah'
            ],
        ];
        
        foreach ($meetings as $meeting) {
            Meeting::create([
                'meeting_name' => $meeting['meeting_name'],
                'topic' => $meeting['topic'],
                'description' => $meeting['description'],
                'type' => $meeting['type'],
            ]);
        }
    }
}
