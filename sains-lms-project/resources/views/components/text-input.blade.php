@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-primary border-gray-300 focus:border-gray-100 focus:ring-gray-200 rounded-md shadow-sm']) }}>
