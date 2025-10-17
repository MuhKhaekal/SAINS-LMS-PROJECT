@extends('dashboard.admin.admin-base')

@section('page-title', 'Sertifikat')

@section('content')
<h1 class="font-extrabold text-2xl mt-20 md:mt-6 md:mx-12">Sertifikasi</h1>

<section class="bg-white shadow-md mt-5 md:mx-12 p-6">
    <div class="">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum cupiditate ipsa, quaerat atque harum et id in, quam accusamus debitis ullam assumenda iusto consectetur repudiandae, illo commodi perspiciatis recusandae excepturi.
    </div>
    <div class="mt-5">
        <x-primary-button>
            {{ 'Unggah Sertifikat' }}
        </x-primary-button>
    </div>
</section>
<section class="bg-white shadow-md mt-5 md:mx-12 p-6">
    <div class="">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum cupiditate ipsa, quaerat atque harum et id in, quam accusamus debitis ullam assumenda iusto consectetur repudiandae, illo commodi perspiciatis recusandae excepturi.
    </div>
    <div class="grid md:grid-cols-3 gap-3 text-center mt-2">
        <div class="bg-secondary rounded-md p-4">
            <h1 class="font-bold">Sertifikat Praktikan</h1>
            <h1 class="mt-2">Fulan bin Fulana</h1>
            <x-primary-button class="mt-2">
                {{ 'Unggah Sertifikat' }}
            </x-primary-button>
        </div>
        <div class="bg-secondary rounded-md p-4">
            <h1 class="font-bold">Sertifikat Asisten</h1>
            <h1 class="mt-2">Fulan bin Fulana</h1>
            <x-primary-button class="mt-2">
                {{ 'Unggah Sertifikat' }}
            </x-primary-button>
        </div>
        <div class="bg-secondary rounded-md p-4">
            <h1 class="font-bold">Sertifikat Praktikan Akhwat Terbaik</h1>
            <h1 class="mt-2">Fulan bin Fulana</h1>
            <x-primary-button class="mt-2">
                {{ 'Unggah Sertifikat' }}
            </x-primary-button>
        </div>
        <div class="bg-secondary rounded-md p-4">
            <h1 class="font-bold">Sertifikat Praktikan Ikhwan Terbaik</h1>
            <h1 class="mt-2">Fulan bin Fulana</h1>
            <x-primary-button class="mt-2">
                {{ 'Unggah Sertifikat' }}
            </x-primary-button>
        </div>
        <div class="bg-secondary rounded-md p-4">
            <h1 class="font-bold">Sertifikat Asisten Akhwat Terbaik</h1>
            <h1 class="mt-2">Fulan bin Fulana</h1>
            <x-primary-button class="mt-2">
                {{ 'Unggah Sertifikat' }}
            </x-primary-button>
        </div>
            <div class="bg-secondary rounded-md p-4">
                <h1 class="font-bold">Sertifikat Asisten Ikhwan Terbaik</h1>
                <h1 class="mt-2">Fulan bin Fulana</h1>
                <x-primary-button class="mt-2">
                    {{ 'Unggah Sertifikat' }}
                </x-primary-button>
            </div>
    </div>
</section>
@endsection