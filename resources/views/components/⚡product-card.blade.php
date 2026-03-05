<?php

use Livewire\Component;

new class extends Component
{
    public string $name = '';
    public string $price = '';
    public string $image = '';
    public string $url = '#';
    public string $badge = '';
    public string $badgeColor = 'red';
    public int $productId = 0;
    public bool $adding = false;

    public function addToCart(): void
    {
        if ($this->productId && function_exists('WC')) {
            WC()->cart->add_to_cart($this->productId);
            $this->dispatch('cart-updated');
        }
    }
};
?>

<div class="bg-white rounded-[1.25rem] flex flex-col subtle-shadow overflow-hidden group hover:shadow-xl transition-all border border-transparent hover:border-slate-100">
    {{-- Imagen --}}
    <a href="{{ $url }}" class="relative aspect-square bg-white overflow-hidden block" wire:navigate>
        <img
            alt="{{ $name }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            src="{{ $image }}"
            loading="lazy"
        />
        @if($badge)
            <span @class([
                'absolute top-4 left-4 text-white text-[10px] font-black px-2.5 py-1 rounded-md uppercase tracking-wider',
                'bg-[#e43f3f]' => $badgeColor === 'red',
                'bg-primary' => $badgeColor === 'orange',
                'bg-green-500' => $badgeColor === 'green',
            ])>
                {{ $badge }}
            </span>
        @endif
    </a>

    {{-- Info --}}
    <div class="p-5 flex-1 flex flex-col">
        <a href="{{ $url }}" wire:navigate>
            <h3 class="text-secondary font-semibold text-sm line-clamp-2 mb-2 min-h-[40px] hover:text-primary transition-colors">
                {{ $name }}
            </h3>
        </a>
        <p class="text-primary font-bold text-xl mb-5">{{ $price }}</p>

        <flux:button
            wire:click="addToCart"
            wire:loading.attr="disabled"
            variant="primary"
            class="!w-full !bg-primary !py-3 !rounded-xl !font-bold !text-sm hover:!bg-[#d14d15] active:!scale-95 mt-auto"
        >
            <span wire:loading.remove wire:target="addToCart">Agregar al Carrito</span>
            <span wire:loading wire:target="addToCart">Agregando...</span>
        </flux:button>
    </div>
</div>
