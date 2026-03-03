<?php

use Livewire\Component;

new class extends Component
{
    public string $icon = 'truck';
    public string $text = '';
    public string $subtext = '';
    public string $ctaLabel = '';
    public string $ctaUrl = '#';
    public string $bgColor = 'primary'; // 'primary' | 'brand-orange'
    public bool $dismissible = true;
    public bool $dismissed = false;

    public function dismiss(): void
    {
        $this->dismissed = true;
    }
};
?>

@if(!$dismissed)
<div
    @class([
        'py-4 px-4 md:px-12 flex flex-col md:flex-row items-center justify-between gap-4 shadow-md',
        'bg-primary' => $bgColor === 'primary',
        'bg-brand-orange rounded-3xl' => $bgColor === 'brand-orange',
    ])
>
    <div class="flex items-center gap-5 flex-1">
        <div class="bg-white/20 p-2.5 rounded-full flex shrink-0">
            @switch($icon)
                @case('truck')
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                    </svg>
                    @break
                @case('credit-card')
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    @break
                @default
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
            @endswitch
        </div>
        <p class="text-white font-semibold text-base md:text-lg tracking-wide text-center md:text-left">
            {{ $text }}
            @if($subtext)
                <span class="text-white/80 font-normal ml-3">— {{ $subtext }}</span>
            @endif
        </p>
    </div>

    <div class="flex items-center gap-6 md:gap-10">
        @if($ctaLabel)
            <flux:button
                as="a"
                href="{{ $ctaUrl }}"
                class="!bg-white !text-primary !text-xs !font-bold !px-8 !py-3 !rounded-full hover:!bg-slate-50 !shadow-sm active:!scale-95 !uppercase !tracking-wider"
            >
                {{ $ctaLabel }}
            </flux:button>
        @endif

        @if($dismissible)
            <button wire:click="dismiss" class="text-white/70 hover:text-white transition-colors flex items-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        @endif
    </div>
</div>
@endif
