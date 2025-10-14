<section>
    <header class="flex flex-col justify-center items-center">
        <svg class="w-16 h-16 md:w-40 md:h-40 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z" clip-rule="evenodd"/>
        </svg>
        <h2 class="text-lg font-medium text-gray-900">
            {{ Auth::user()->name }}
        </h2>

        <p class="mt-1 text-sm mb-2 text-gray-600">
            {{ Auth::user()->nim }}
        </p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-delete-button :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-delete-button>
        </form>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Fakultas')" />
            <x-text-input-secondary id="name" name="name" type="text" class="mt-1 block w-full text-sm text-gray-600" :value="old('name', $user->name)" required autofocus disabled autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Kelas PAI')" />
            <x-text-input-secondary id="name" name="name" type="text" class="mt-1 block w-full text-sm text-gray-600" :value="old('name', $user->name)" required disabled autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="nim" :value="__('Halaqah')" />
            <x-text-input-secondary id="nim" name="nim" type="text" class="mt-1 block w-full text-sm text-gray-600" :value="old('nim', $user->nim)" required disabled autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('nim')" />
        </div>
    </div>
</section>
