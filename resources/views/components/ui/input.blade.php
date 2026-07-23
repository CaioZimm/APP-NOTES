@props(['disabled' => false, 'error' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full h-11 px-4 bg-transparent text-gray-900 dark:text-gray-100 border outline-none rounded-md transition-colors duration-200 focus:ring-2 focus:ring-blue-500 ' . ($error ? 'border-red-500 focus:border-red-500' : 'border-gray-400 focus:border-blue-500')]) !!}>
