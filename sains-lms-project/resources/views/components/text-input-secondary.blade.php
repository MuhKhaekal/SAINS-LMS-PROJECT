@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'text-sm bg-secondary text-primary border-gray-300 focus:border-gray-500 focus:ring-blue-500 rounded-md shadow-sm']) }}>
