@extends('dashboard.praktikan.praktikan-base')


@section('page-title', 'SAINS | Beranda')

@section('content')
    <div class="relative w-full h-[600px] md:h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/90 to-primary/60 mix-blend-multiply"></div>
            <img src="{{ asset('assets/images/background-home.png') }}" alt="Background" class="w-full h-full object-cover">
        </div>

        <div class="container mx-auto px-6 md:px-12 text-center md:text-left flex flex-col md:flex-row items-center">
            <div class="md:w-2/3 text-white">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6" data-aos="fade-right">
                    Bangun dan Wujudkan <br> <span class="text-yellow-400">Cita-cita</span> Bersama SAINS
                </h1>
                <p class="text-sm md:text-lg font-light leading-relaxed mb-8 max-w-2xl text-gray-100" data-aos="fade-up"
                    data-aos-delay="100">
                    SAINS adalah program pengajaran Al-Qur'an yang membantu mahasiswa Universitas Hasanuddin (Unhas)
                    meraih cita-cita dan mewujudkan kampus bebas buta aksara.
                </p>
                <div data-aos="fade-up" data-aos-delay="200">
                    <x-secondary-button class="px-8 py-3 text-base">
                        {{ __('Selengkapnya') }}
                        <svg class="w-4 h-4 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </x-secondary-button>
                </div>
            </div>
        </div>
    </div>

    <section class="py-16 md:py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row items-center gap-12 mb-16 md:mb-24">
                <div class="w-full md:w-1/2" data-aos="fade-right">
                    <span class="text-primary font-bold tracking-wider uppercase text-sm mb-2 block">Tentang Kami</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                        Program Peningkatan <br> Pemahaman Al-Qur'an
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        SAINS diharapkan menjadi program yang bermanfaat dalam pendidikan, meningkatkan pemahaman Al-Qur'an
                        dan praktik ajaran Islam bagi mahasiswa, menciptakan generasi yang cerdas intelektual dan spiritual.
                    </p>
                </div>
                <div class="w-full md:w-1/2" data-aos="fade-left">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('assets/images/picture-home-1.png') }}" alt="Tentang SAINS"
                            class="w-full h-auto transform hover:scale-105 transition duration-500">
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row-reverse items-center gap-12">
                <div class="w-full md:w-1/2" data-aos="fade-left">
                    <span class="text-primary font-bold tracking-wider uppercase text-sm mb-2 block">Visi Kami</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                        Mewujudkan Kampus <br> Bebas Buta Aksara
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        Kami berkomitmen untuk memberantas buta aksara Al-Qur'an di lingkungan kampus melalui metode
                        pengajaran yang efektif, inklusif, dan mudah diakses oleh seluruh mahasiswa.
                    </p>
                </div>
                <div class="w-full md:w-1/2" data-aos="fade-right">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('assets/images/picture-home-2.png') }}" alt="Visi SAINS"
                            class="w-full h-auto transform hover:scale-105 transition duration-500">
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="py-20 bg-primary relative">
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Mengapa Harus SAINS?</h2>
                <p class="text-gray-200 max-w-2xl mx-auto">Berbagai manfaat yang akan Anda dapatkan dengan bergabung dalam
                    program pembinaan ini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $benefits = [
                        [
                            'title' => 'Peningkatan Pemahaman',
                            'desc' =>
                                "Memperdalam pemahaman terhadap Al-Qur'an dan aplikasinya dalam kehidupan sehari-hari.",
                        ],
                        [
                            'title' => 'Keterampilan Membaca',
                            'desc' =>
                                "Latihan membaca Al-Qur'an dengan tajwid yang benar, meningkatkan kemampuan membaca secara umum.",
                        ],
                        [
                            'title' => 'Karakter Positif',
                            'desc' =>
                                "Mengembangkan karakter positif, seperti disiplin dan empati, melalui nilai-nilai ajaran Al-Qur'an.",
                        ],
                        [
                            'title' => 'Lingkungan Positif',
                            'desc' =>
                                'Menciptakan atmosfer kampus yang mendukung pembelajaran dan mengurangi buta aksara.',
                        ],
                        [
                            'title' => 'Akses Fleksibel',
                            'desc' =>
                                'Program ini gratis dan dapat diakses dengan mudah, memberikan kemudahan bagi mahasiswa.',
                        ],
                        [
                            'title' => 'Komunitas Solid',
                            'desc' =>
                                'Kesempatan untuk berinteraksi dan bersinergi dengan mahasiswa lain yang memiliki minat yang sama.',
                        ],
                    ];
                @endphp

                @foreach ($benefits as $index => $benefit)
                    <div class="bg-white rounded-xl p-6 shadow-lg hover:-translate-y-2 transition duration-300 relative overflow-hidden group"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-gray-50 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-yellow-50">
                        </div>

                        <div class="relative z-10 flex items-start">
                            <div
                                class="flex-shrink-0 w-10 h-10 bg-primary text-white rounded-lg flex items-center justify-center font-bold shadow-md mr-4 group-hover:scale-110 transition">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-primary transition">
                                    {{ $benefit['title'] }}</h3>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    {{ $benefit['desc'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-2">Kata Mereka Tentang SAINS</h2>
                <p class="text-gray-500 font-medium">Bergabunglah dengan 10.000+ mahasiswa lainnya</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @for ($i = 0; $i < 3; $i++)
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300"
                        data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        <svg class="w-8 h-8 text-yellow-400 mb-4 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.0166 21L5.0166 18C5.0166 16.8954 5.91203 16 7.0166 16H10.0166C10.5689 16 11.0166 15.5523 11.0166 15V9C11.0166 8.44772 10.5689 8 10.0166 8H6.0166C5.46432 8 5.0166 8.44772 5.0166 9V11C5.0166 11.5523 4.56889 12 4.0166 12H3.0166V5H13.0166V15C13.0166 18.3137 10.3303 21 7.0166 21H5.0166Z">
                            </path>
                        </svg>

                        <p class="text-gray-600 italic mb-6 leading-relaxed">
                            "Setelah mengikuti kelas SAINS, ilmu saya tentang Al-Quran itu bertambah drastis. Terima kasih
                            kepada kakak-kakak SAINS yang telah membimbing kami sesabar mungkin."
                        </p>

                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold mr-3">
                                SA
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900">Surya Agus Nanro</h4>
                                <p class="text-xs text-primary font-medium">Mahasiswa Sistem Informasi</p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

@endsection
