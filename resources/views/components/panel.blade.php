@php
$classes = 'p-4 bg-white/5 rounded-xl flex border border-transparent hover:border-blue-600 group transition-colors duration-500';
@endphp
<div {{$attributes->merge(['class' => $classes])}}>
    {{$slot}}
</div>


