<?php

use Livewire\Component;

new class extends Component
{
    public string $label = 'CARGAR MÁS';
    public bool $loading = false;

    public function loadMore(): void
    {
        $this->loading = true;
        $this->dispatch('load-more-products');
    }
};
?>

<div class="flex flex-col items-center py-12">
    <flux:button
        wire:click="loadMore"
        wire:loading.attr="disabled"
        variant="primary"
        class="!bg-primary hover:!bg-[#d14d15] !text-white !font-bold !py-4 !px-14 !rounded-full !transition-all !duration-300 !shadow-lg hover:!shadow-xl active:!scale-95 !uppercase !tracking-widest !text-sm"
    >
        <span wire:loading.remove wire:target="loadMore">{{ $label }}</span>
        <span wire:loading wire:target="loadMore">
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Cargando...
        </span>
    </flux:button>
</div>
