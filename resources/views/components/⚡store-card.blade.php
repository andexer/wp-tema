<?php

use Livewire\Component;

new class extends Component
{
    public string $name = '';
    public string $offer = '';
    public string $badge = '';
    public string $imageUrl = '';
    public string $link = '#';
    public string $aspectRatio = '4/5'; // '4/5' o '16/9'
};
?>

<a
    href="{{ $link }}"
    @class([
        'relative rounded-2xl overflow-hidden shadow-lg group block',
        'aspect-[4/5]' => $aspectRatio === '4/5',
        'aspect-[16/9]' => $aspectRatio === '16/9',
    ])
    wire:navigate
>
    <img
        alt="{{ $name }}"
        class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
        src="{{ $imageUrl }}"
        loading="lazy"
    />
    <div class="absolute inset-0 store-overlay-gradient"></div>

    <div class="absolute bottom-6 md:bottom-8 left-6 md:left-8 text-white pr-4">
        <h4 @class([
            'font-bold mb-1 md:mb-2 leading-tight',
            'text-2xl md:text-3xl' => $aspectRatio === '4/5',
            'text-xl md:text-2xl' => $aspectRatio === '16/9',
        ])>
            {{ $name }}
        </h4>
        <p class="text-sm md:text-base font-medium opacity-90">{{ $offer }}</p>
    </div>

    @if($badge)
        <div class="absolute top-4 md:top-6 left-4 md:left-6 bg-white/10 backdrop-blur-md px-3 py-1 md:py-1.5 rounded-lg text-[9px] md:text-[10px] text-white font-bold tracking-wider uppercase">
            {{ $badge }}
        </div>
    @endif
</a>
