@extends('dashboard.asisten.asisten-base')

@section('page-title', 'Beranda')

@section('content')
<div style="background-image: linear-gradient(rgba(9, 59, 59, 0.7), rgba(9, 59, 59, 0.7)), url('/assets/images/background-home.png');" class="bg-no-repeat mx-0 bg-center bg-cover h-80 md:h-screen bg-primary md:flex md:items-center">
    <div class="relative mx-5 text-secondary pt-36 md:pt-0 md:w-1/2 md:mx-24">
        <h1 class="font-semibold text-xl md:text-4xl" data-aos="fade-right">Bangun dan Wujudkan Cita-cita Bersama SAINS</h1>
        <p class="text-xs leading-loose font-light md:text-lg md:mt-7" data-aos="fade-up">SAINS adalah program pengajaran Al-Qur'an yang membantu mahasiswa Universitas Hasanuddin (Unhas) meraih cita-cita dan mewujudkan kampus bebas buta aksara.</p>
        <x-secondary-button data-aos="fade-up" class="hidden md:block md:mt-7">
            {{ __('Selengkapnya ->') }}
        </x-secondary-button>
    </div>
</div>


{{-- DESKTOP --}}
<section class="hidden md:block mx-24 my-24">
    <div class="flex items-center">
        <div class="flex-1 mx-5" data-aos="fade-right">
            <h1 class="text-primary font-semibold text-md mb-4">Tentang Kami</h1>
            <h1 class="text-black font-semibold text-2xl mb-2">SAINS: Program untuk Meningkatkan Pemahaman Al-Qur'an</h1>
            <p class="text-xs font-light leading-loose text-gray-700">SAINS diharapkan menjadi program yang bermanfaat dalam pendidikan, meningkatkan pemahaman Al-Qur'an dan praktik ajaran Islam bagi mahasiswa.</p>
        </div>
        <div class="flex-1 mx-5" data-aos="fade-left">
            <img class="my-2" src="{{ asset('assets/images/picture-home-1.png') }}" alt="">
        </div>  
    </div>
    <div class="flex flex-row-reverse items-center">
        <div class="flex-1 mx-5" data-aos="fade-left">
            <h1 class="text-primary font-semibold text-md mb-4">Tentang Kami</h1>
            <h1 class="text-black font-semibold text-2xl mb-2">SAINS: Program untuk Meningkatkan Pemahaman Al-Qur'an</h1>
            <p class="text-xs font-light leading-loose text-gray-700">SAINS diharapkan menjadi program yang bermanfaat dalam pendidikan, meningkatkan pemahaman Al-Qur'an dan praktik ajaran Islam bagi mahasiswa.</p>
        </div>
        <div class="flex-1 mx-5" data-aos="fade-right">
            <img class="my-2" src="{{ asset('assets/images/picture-home-1.png') }}" alt="">
        </div>  
    </div>
</section>

{{-- MOBILE --}}
<section class="tentang-kami-mobile md:hidden p-4 mb-2">
    <h1 class="text-primary font-semibold text-sm text-center mb-4" data-aos="fade-up">Tentang Kami</h1>
    <h1 class="text-black font-semibold text-xs mb-2" data-aos="fade-right">SAINS: Program untuk Meningkatkan Pemahaman Al-Qur'an</h1>
    <p class="text-xs font-light leading-loose" data-aos="fade-right">SAINS diharapkan menjadi program yang bermanfaat dalam pendidikan, meningkatkan pemahaman Al-Qur'an dan praktik ajaran Islam bagi mahasiswa.</p>
    <img class="my-2" src="{{ asset('assets/images/picture-home-1.png') }}" alt="" data-aos="fade-left">
    <img class="" src="{{ asset('assets/images/picture-home-2.png') }}" alt="" data-aos="fade-right">
</section>

<section class="keuntungan bg-primary p-4 md:p-24">
    <h1 class="text-secondary font-semibold text-sm text-center mb-4 md:text-3xl md:mb-20" data-aos="fade-right">Keuntungan Berpartisipasi dalam Program SAINS</h1>

    <div class="grid md:grid-cols-3 gap-2 md:gap-4">
        <div class="bg-gray-200 flex p-4 rounded-lg" data-aos="fade-left">
            <div class="bg-primary rounded-lg w-8 h-8 me-4 md:hidden">
                <div class="relative bg-yellow-100 w-2 h-5 top-3 rounded-tr-lg rounded-bl-lg">
                </div>
                <p class="text-center text-secondary -mt-3 ms-1 font-bold text-sm">1</p>
            </div>
            <div class="flex-1 md:p-6">
                <div class="hidden md:block bg-primary rounded-lg w-8 h-8 me-4 mb-4">
                    <div class="relative bg-yellow-100 w-2 h-5 top-3 rounded-tr-lg rounded-bl-lg">
                    </div>
                    <p class="text-center text-secondary -mt-3 ms-1 font-bold text-sm">1</p>
                </div>
                <h1 class="font-bold text-xs md:text-lg">Peningkatan Pemahaman</h1>
                <p class="text-xs font-thin text-gray-700 md:text-sm">Memperdalam pemahaman terhadap Al-Qur'an dan aplikasinya dalam kehidupan sehari-hari.</p>
            </div>
        </div>
        <div class="bg-gray-200 flex p-4 rounded-lg" data-aos="fade-left">
            <div class="bg-primary rounded-lg w-8 h-8 me-4 md:hidden">
                <div class="relative bg-yellow-100 w-2 h-5 top-3 rounded-tr-lg rounded-bl-lg">
                </div>
                <p class="text-center text-secondary -mt-3 ms-1 font-bold text-sm">2</p>
            </div>
            <div class="flex-1 md:p-6">
                <div class="hidden md:block bg-primary rounded-lg w-8 h-8 me-4 mb-4">
                    <div class="relative bg-yellow-100 w-2 h-5 top-3 rounded-tr-lg rounded-bl-lg">
                    </div>
                    <p class="text-center text-secondary -mt-3 ms-1 font-bold text-sm">2</p>
                </div>
                <h1 class="font-bold text-xs md:text-lg">Keterampilan Membaca</h1>
                <p class="text-xs font-thin text-gray-700 md:text-sm">Latihan membaca Al-Qur'an dengan tajwid yang benar, meningkatkan kemampuan membaca secara umum.</p>
            </div>
        </div>
        <div class="bg-gray-200 flex p-4 rounded-lg" data-aos="fade-left">
            <div class="bg-primary rounded-lg w-8 h-8 me-4 md:hidden">
                <div class="relative bg-yellow-100 w-2 h-5 top-3 rounded-tr-lg rounded-bl-lg">
                </div>
                <p class="text-center text-secondary -mt-3 ms-1 font-bold text-sm">3</p>
            </div>
            <div class="flex-1 md:p-6">
                <div class="hidden md:block bg-primary rounded-lg w-8 h-8 me-4 mb-4">
                    <div class="relative bg-yellow-100 w-2 h-5 top-3 rounded-tr-lg rounded-bl-lg">
                    </div>
                    <p class="text-center text-secondary -mt-3 ms-1 font-bold text-sm">3</p>
                </div>
                <h1 class="font-bold text-xs md:text-lg">Karakter Positif</h1>
                <p class="text-xs font-thin text-gray-700 md:text-sm">Mengembangkan karakter positif, seperti disiplin dan empati, melalui nilai-nilai ajaran Al-Qur'an.</p>
            </div>
        </div>
        <div class="bg-gray-200 flex p-4 rounded-lg" data-aos="fade-right">
            <div class="bg-primary rounded-lg w-8 h-8 me-4 md:hidden">
                <div class="relative bg-yellow-100 w-2 h-5 top-3 rounded-tr-lg rounded-bl-lg">
                </div>
                <p class="text-center text-secondary -mt-3 ms-1 font-bold text-sm">4</p>
            </div>
            <div class="flex-1 md:p-6">
                <div class="hidden md:block bg-primary rounded-lg w-8 h-8 me-4 mb-4">
                    <div class="relative bg-yellow-100 w-2 h-5 top-3 rounded-tr-lg rounded-bl-lg">
                    </div>
                    <p class="text-center text-secondary -mt-3 ms-1 font-bold text-sm">4</p>
                </div>
                <h1 class="font-bold text-xs md:text-lg">Lingkungan Positif</h1>
                <p class="text-xs font-thin text-gray-700 md:text-sm">Menciptakan atmosfer kampus yang mendukung pembelajaran dan mengurangi buta aksara.</p>
            </div>
        </div>
        <div class="bg-gray-200 flex p-4 rounded-lg" data-aos="fade-right">
            <div class="bg-primary rounded-lg w-8 h-8 me-4 md:hidden">
                <div class="relative bg-yellow-100 w-2 h-5 top-3 rounded-tr-lg rounded-bl-lg">
                </div>
                <p class="text-center text-secondary -mt-3 ms-1 font-bold text-sm">5</p>
            </div>
            <div class="flex-1 md:p-6">
                <div class="hidden md:block bg-primary rounded-lg w-8 h-8 me-4 mb-4">
                    <div class="relative bg-yellow-100 w-2 h-5 top-3 rounded-tr-lg rounded-bl-lg">
                    </div>
                    <p class="text-center text-secondary -mt-3 ms-1 font-bold text-sm">5</p>
                </div>
                <h1 class="font-bold text-xs md:text-lg">Akses Fleksibel</h1>
                <p class="text-xs font-thin text-gray-700 md:text-sm">Program ini gratis dan dapat diakses secara online, memberikan kemudahan bagi mahasiswa.</p>
            </div>
        </div>
        <div class="bg-gray-200 flex p-4 rounded-lg" data-aos="fade-right">
            <div class="bg-primary rounded-lg w-8 h-8 me-4 md:hidden" >
                <div class="relative bg-yellow-100 w-2 h-5 top-3 rounded-tr-lg rounded-bl-lg">
                </div>
                <p class="text-center text-secondary -mt-3 ms-1 font-bold text-sm">6</p>
            </div>
            <div class="flex-1 md:p-6">
                <div class="hidden md:block bg-primary rounded-lg w-8 h-8 me-4 mb-4">
                    <div class="relative bg-yellow-100 w-2 h-5 top-3 rounded-tr-lg rounded-bl-lg">
                    </div>
                    <p class="text-center text-secondary -mt-3 ms-1 font-bold text-sm">6</p>
                </div>
                <h1 class="font-bold text-xs md:text-lg">Komunitas Solid</h1>
                <p class="text-xs font-thin text-gray-700 md:text-sm">Kesempatan untuk berinteraksi dan bersinergi dengan mahasiswa lain yang memiliki minat yang sama.</p>
            </div>
        </div>

    </div>

</section>

{{-- DESKTOP --}}
<section class="hidden md:block mx-24 my-24">
    <div class="flex items-center">
        <div class="flex-1 mx-5" data-aos="fade-right" >
            <h1 class="text-primary font-semibold text-2xl mb-1 text-center" >Kata Mereka Tentang SAINS</h1>
                <h1 class="text-gray-500 text-sm mb-4 text-center">SAINS telah diikuti lebih dari 10.000 mahasiswa</h1>
        </div>
        <div class="flex-1 mx-5 space-y-10" data-aos="fade-left">
            <div class="">
                <p class="text-xs mb-1">"Setelah mengikuti kelas SAINS, ilmu saya tentang Al-Quran itu bertambah drastis. Terima kasih kepada kakak-kakak SAINS yang telah membimbing kami sesabar mungkin."</p>
                <h1 class="text-sm font-bold">Surya Agus Nanro</h1>
                <p class="text-sm text-gray-500 font-thin">Mahasiswa Sistem Informasi</p>
            </div>
            <div class="">
                <p class="text-xs mb-1">"Setelah mengikuti kelas SAINS, ilmu saya tentang Al-Quran itu bertambah drastis. Terima kasih kepada kakak-kakak SAINS yang telah membimbing kami sesabar mungkin."</p>
                <h1 class="text-sm font-bold">Surya Agus Nanro</h1>
                <p class="text-sm text-gray-500 font-thin">Mahasiswa Sistem Informasi</p>
            </div>
            <div class="">
                <p class="text-xs mb-1">"Setelah mengikuti kelas SAINS, ilmu saya tentang Al-Quran itu bertambah drastis. Terima kasih kepada kakak-kakak SAINS yang telah membimbing kami sesabar mungkin."</p>
                <h1 class="text-sm font-bold">Surya Agus Nanro</h1>
                <p class="text-sm text-gray-500 font-thin">Mahasiswa Sistem Informasi</p>
            </div>
            <div class="">
                <p class="text-xs mb-1">"Setelah mengikuti kelas SAINS, ilmu saya tentang Al-Quran itu bertambah drastis. Terima kasih kepada kakak-kakak SAINS yang telah membimbing kami sesabar mungkin."</p>
                <h1 class="text-sm font-bold">Surya Agus Nanro</h1>
                <p class="text-sm text-gray-500 font-thin">Mahasiswa Sistem Informasi</p>
            </div>
            <div class="">
                <p class="text-xs mb-1">"Setelah mengikuti kelas SAINS, ilmu saya tentang Al-Quran itu bertambah drastis. Terima kasih kepada kakak-kakak SAINS yang telah membimbing kami sesabar mungkin."</p>
                <h1 class="text-sm font-bold">Surya Agus Nanro</h1>
                <p class="text-sm text-gray-500 font-thin">Mahasiswa Sistem Informasi</p>
            </div>
        </div>  
    </div>
</section>

{{-- MOBILE --}}
<section class="kata-mereka-mobile p-4 md:hidden">
    <h1 class="text-primary font-semibold text-sm text-center mb-1" data-aos="fade-right">Kata Mereka Tentang SAINS</h1>
    <h1 class="text-gray-500 font-semibold text-xs mb-4 text-center" data-aos="fade-right">SAINS telah diikuti lebih dari 10.000 mahasiswa</h1>
    <div class="mb-4" data-aos="fade-left">
        <p class="text-xs mb-1">"Setelah mengikuti kelas SAINS, ilmu saya tentang Al-Quran itu bertambah drastis. Terima kasih kepada kakak-kakak SAINS yang telah membimbing kami sesabar mungkin."</p>
        <h1 class="text-sm font-bold">Surya Agus Nanro</h1>
        <p class="text-sm text-gray-500 font-thin">Mahasiswa Sistem Informasi</p>
    </div>
    <div class="" data-aos="fade-left">
        <p class="text-xs mb-1" >"Setelah mengikuti kelas SAINS, ilmu saya tentang Al-Quran itu bertambah drastis. Terima kasih kepada kakak-kakak SAINS yang telah membimbing kami sesabar mungkin."</p>
        <h1 class="text-sm font-bold">Surya Agus Nanro</h1>
        <p class="text-sm text-gray-500 font-thin">Mahasiswa Sistem Informasi</p>
    </div>
</section>

@endsection 