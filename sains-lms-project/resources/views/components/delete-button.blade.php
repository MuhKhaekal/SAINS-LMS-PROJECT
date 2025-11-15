<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-normal text-xs text-white  tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
