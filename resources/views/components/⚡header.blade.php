<?php

use Livewire\Component;

new class extends Component
{
    public int $cartCount = 0;

    public function mount(): void
    {
        if (function_exists('WC') && WC()->cart) {
            $this->cartCount = WC()->cart->get_cart_contents_count();
        }
    }

    public function getSiteNameProperty(): string
    {
        return get_bloginfo('name');
    }

    public function getHomeUrlProperty(): string
    {
        return home_url('/');
    }

    public function getCartUrlProperty(): string
    {
        return function_exists('wc_get_cart_url') ? wc_get_cart_url() : '#';
    }

    public function getAccountUrlProperty(): string
    {
        return function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : '#';
    }

    public function getShopUrlProperty(): string
    {
        return function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '#';
    }
};
?>

<div>
    {{-- ═══ Header Principal ═══ --}}
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50 h-20 flex items-center">
        <div class="container mx-auto px-4 lg:px-8 flex items-center justify-between gap-6">

            {{-- Logo --}}
            <a href="{{ $this->homeUrl }}" class="flex items-center gap-3 shrink-0" wire:navigate>
                <div class="bg-primary p-2 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold tracking-tight text-secondary">{{ $this->siteName }}</span>
            </a>

            {{-- Buscador Desktop --}}
            <div class="flex-1 max-w-xl hidden md:block">
                <flux:input
                    icon="magnifying-glass"
                    placeholder="Busca productos, marcas y más..."
                    class="!rounded-full !bg-slate-100 !border-none"
                />
            </div>

            {{-- Navegación Desktop --}}
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a class="hover:text-primary transition-colors py-2" href="{{ $this->shopUrl }}" wire:navigate>Tienda</a>
                <a class="hover:text-primary transition-colors py-2" href="#">Calculadora de Envío</a>
                <a class="hover:text-primary transition-colors py-2" href="#">Rastrea tu Paquete</a>
            </nav>

            {{-- Acciones --}}
            <div class="flex items-center gap-2">
                {{-- Botón búsqueda móvil --}}
                <flux:button variant="ghost" icon="magnifying-glass" class="md:hidden !text-slate-700" />

                {{-- Carrito --}}
                <a href="{{ $this->cartUrl }}" class="relative p-2 hover:bg-slate-100 rounded-full transition-colors" wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                    </svg>
                    @if($cartCount > 0)
                        <span class="absolute top-1 right-1 bg-primary text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold">{{ $cartCount }}</span>
                    @endif
                </a>

                {{-- Usuario --}}
                <a href="{{ $this->accountUrl }}" class="p-2 hover:bg-slate-100 rounded-full transition-colors" wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </a>

                {{-- Menú hamburguesa móvil --}}
                <flux:button variant="ghost" icon="bars-3" class="lg:hidden !text-slate-700" x-on:click="$dispatch('toggle-mobile-menu')" />
            </div>
        </div>
    </header>

    {{-- ═══ Mobile Sidebar ═══ --}}
    <div
        x-data="{ open: false }"
        x-on:toggle-mobile-menu.window="open = !open"
        x-show="open"
        x-cloak
        class="fixed inset-0 z-[60] lg:hidden"
    >
        <div x-show="open" x-transition.opacity class="absolute inset-0 bg-black/50" x-on:click="open = false"></div>
        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="absolute inset-y-0 left-0 w-80 bg-white shadow-2xl">
            <div class="p-6 space-y-6">
                <div class="flex items-center justify-between">
                    <span class="text-xl font-bold text-secondary">{{ $this->siteName }}</span>
                    <flux:button variant="ghost" icon="x-mark" x-on:click="open = false" />
                </div>

                <flux:input icon="magnifying-glass" placeholder="Buscar..." />

                <nav class="space-y-1">
                    <a href="{{ $this->shopUrl }}" class="block px-4 py-3 rounded-xl text-slate-700 font-semibold hover:bg-slate-100 hover:text-primary transition-colors">Tienda</a>
                    <a href="#" class="block px-4 py-3 rounded-xl text-slate-700 font-semibold hover:bg-slate-100 hover:text-primary transition-colors">Calculadora de Envío</a>
                    <a href="#" class="block px-4 py-3 rounded-xl text-slate-700 font-semibold hover:bg-slate-100 hover:text-primary transition-colors">Rastrea tu Paquete</a>
                </nav>

                <flux:separator />

                <div class="space-y-1">
                    <a href="{{ $this->cartUrl }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-semibold hover:bg-slate-100 hover:text-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                        Mi Carrito
                        @if($cartCount > 0)
                            <flux:badge size="sm" color="accent">{{ $cartCount }}</flux:badge>
                        @endif
                    </a>
                    <a href="{{ $this->accountUrl }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-semibold hover:bg-slate-100 hover:text-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Mi Cuenta
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>