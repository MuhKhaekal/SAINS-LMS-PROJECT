@extends('dashboard.admin.admin-base')

@section('page-title', 'Daftar Pengguna')

@section('content')
<h1 class="font-extrabold text-2xl mt-20 md:mt-6 md:mx-12">Daftar Pengguna</h1>

<section class="md:mx-12">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-400">
            <thead class="text-xs uppercase bg-primary text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        NIM
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white hover:bg-gray-100 text-primary border-b">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap ">
                        Fulan
                    </th>
                    <td class="px-6 py-4">
                        H071221039
                    </td>
                    <td class="px-6 py-4">
                        Praktikan
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <a href="#" class="font-medium text-blue-500 hover:underline">Edit</a>
                        <a href="#" class="font-medium text-red-500 hover:underline">Hapus</a>
                    </td>
                </tr>
    
    
            </tbody>
        </table>
    </div>


</section>

<section class="md:mx-12 mt-5">
    <x-primary-button class="text-center">
        {{ __('+ Tambah Akun') }}
    </x-primary-button>
</section>




@endsection