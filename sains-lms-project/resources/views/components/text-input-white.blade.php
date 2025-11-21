@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white text-primary border-gray-300 focus:border-gray-500 focus:ring-primary rounded-md shadow-sm']) }}>
