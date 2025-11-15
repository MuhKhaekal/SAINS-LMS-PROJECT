<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            ['question' => 'Apa itu SAINS?', 'answer' => 'SAINS merupakan kepanjangan dari Studi Al-Quran Intensif Unhas yang diadakan 6 pekan dan akan diikuti oleh mahasiswa baru di setiap tahunnya'],
            ['question' => 'Apa manfaat SAINS?', 'answer' => 'SAINS tentunya dapat memperkuat pemahaman tentang bacaan Al-Quran'],
            ['question' => 'Siapa yang menjadi pengajar di SAINS nantinya?', 'answer' => 'Terdapat asisten-asisten yang terpilih dan tentunya melalui seleksi dengan mempertimbangkan banyak hal'],
            ['question' => 'Berapa lama pertemuan SAINS itu?', 'answer' => 'Ada 6 pekan termasuk pertemuan untuk pre-test dan post-test'],
            ['question' => 'Apa yang perlu dipersiapkan sebelum mengikuti SAINS?', 'answer' => 'Antum hanya cukup untuk menyediakan Al-Quran, membawa kartu kontrolnya karena di setiap pertemuan akan di paraf oleh asisten masing-masing'],
        ];

        
        foreach ($faqs as $faq) {
            Faq::create([
                'question' => $faq['question'],
                'answer' => $faq['answer']
            ]);
        }
        
    }
}
