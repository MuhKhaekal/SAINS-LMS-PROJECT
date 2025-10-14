@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white border-gray-300 focus:border-gray-500 focus:ring-gray-700 rounded-md shadow-sm']) }}>
