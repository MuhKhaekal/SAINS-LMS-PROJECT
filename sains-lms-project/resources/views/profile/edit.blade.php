
@extends('dashboard.asisten.asisten-base')

@section('page-title', 'Halaqah')

@section('content')
    <div class="mx-4 md:mx-96 md:mt-24">
        <div class="space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 mb-12 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>

@endsection
