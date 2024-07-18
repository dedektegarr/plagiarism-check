@props(['message', 'status'])

@php
    $color = $status == 'success' ? 'green' : 'red';
@endphp

<div class="p-4 rounded-md border border-{{ $color }}-400 bg-{{ $color }}-400/20">
    <p class="text-sm text-{{ $color }}-400 mb-0">{{ $message }}</p>
</div>
