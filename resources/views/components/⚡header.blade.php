<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public int $cartCount = 0;
    public array $cartItems = [];
    public string $cartTotal = '';

    public function mount(): void
    {
        $this->refreshCart();
    }

    #[On('cart-updated')]
    public function refreshCart(): void
    {
        if (function_exists('WC') && WC()->cart) {
            $this->cartCount = WC()->cart->get_cart_contents_count();
            $this->cartTotal = WC()->cart->get_total();

            $this->cartItems = [];
            foreach (WC()->cart->get_cart() as $cartKey => $cartItem) {
                $product = $cartItem['data'];
                $this->cartItems[] = [
                    'key'       => $cartKey,
                    'id'        => $cartItem['product_id'],
                    'name'      => $product->get_name(),
                    'price'     => $product->get_price_html(),
                    'quantity'  => $cartItem['quantity'],
                    'image'     => wp_get_attachment_url($product->get_image_id()) ?: wc_placeholder_img_src(),
                    'url'       => $product->get_permalink(),
                    'subtotal'  => WC()->cart->get_product_subtotal($product, $cartItem['quantity']),
                ];
            }
        }
    }

    public function removeFromCart(string $cartKey): void
    {
        if (function_exists('WC') && WC()->cart) {
            WC()->cart->remove_cart_item($cartKey);
            $this->refreshCart();
        }
    }

    public function updateQuantity(string $cartKey, int $quantity): void
    {
        if (function_exists('WC') && WC()->cart) {
            if ($quantity <= 0) {
                WC()->cart->remove_cart_item($cartKey);
            } else {
                WC()->cart->set_quantity($cartKey, $quantity);
            }
            $this->refreshCart();
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

    public function getCheckoutUrlProperty(): string
    {
        return function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : '#';
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

                {{-- Carrito - Modal Trigger --}}
                <flux:modal.trigger name="cart-flyout">
                    <button class="relative p-2 hover:bg-slate-100 rounded-full transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        @if($cartCount > 0)
                            <span class="absolute top-0 right-0 bg-primary text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-bold">{{ $cartCount }}</span>
                        @endif
                    </button>
                </flux:modal.trigger>

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

    {{-- ═══ Cart Flyout Modal ═══ --}}
    <flux:modal name="cart-flyout" variant="flyout" class="md:w-lg">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <flux:heading size="lg">Mi Carrito</flux:heading>
                @if($cartCount > 0)
                    <flux:badge color="accent" size="sm">{{ $cartCount }} {{ $cartCount === 1 ? 'producto' : 'productos' }}</flux:badge>
                @endif
            </div>

            @if(count($cartItems) > 0)
                {{-- Lista de productos --}}
                <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-1">
                    @foreach($cartItems as $item)
                        <div class="flex gap-4 p-3 bg-slate-50 rounded-xl" wire:key="cart-item-{{ $item['key'] }}">
                            {{-- Imagen --}}
                            <a href="{{ $item['url'] }}" class="shrink-0" wire:navigate>
                                <img
                                    src="{{ $item['image'] }}"
                                    alt="{{ $item['name'] }}"
                                    class="w-20 h-20 object-cover rounded-lg"
                                />
                            </a>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <a href="{{ $item['url'] }}" class="block" wire:navigate>
                                    <h4 class="text-sm font-semibold text-secondary line-clamp-2 hover:text-primary transition-colors">
                                        {{ $item['name'] }}
                                    </h4>
                                </a>
                                <p class="text-primary font-bold text-sm mt-1">{!! $item['price'] !!}</p>

                                {{-- Cantidad --}}
                                <div class="flex items-center justify-between mt-2">
                                    <div class="flex items-center gap-1">
                                        <flux:button
                                            variant="ghost"
                                            size="xs"
                                            icon="minus"
                                            wire:click="updateQuantity('{{ $item['key'] }}', {{ $item['quantity'] - 1 }})"
                                            class="!w-7 !h-7 !rounded-lg"
                                        />
                                        <span class="w-8 text-center text-sm font-semibold">{{ $item['quantity'] }}</span>
                                        <flux:button
                                            variant="ghost"
                                            size="xs"
                                            icon="plus"
                                            wire:click="updateQuantity('{{ $item['key'] }}', {{ $item['quantity'] + 1 }})"
                                            class="!w-7 !h-7 !rounded-lg"
                                        />
                                    </div>

                                    {{-- Subtotal y eliminar --}}
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs text-slate-500">{!! $item['subtotal'] !!}</span>
                                        <flux:button
                                            variant="ghost"
                                            size="xs"
                                            icon="trash"
                                            wire:click="removeFromCart('{{ $item['key'] }}')"
                                            wire:confirm="¿Eliminar este producto del carrito?"
                                            class="!text-red-500 hover:!text-red-700 !w-7 !h-7"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Total --}}
                <flux:separator />

                <div class="flex items-center justify-between px-1">
                    <span class="text-base font-bold text-secondary">Total</span>
                    <span class="text-xl font-bold text-primary">{!! $cartTotal !!}</span>
                </div>

                {{-- Botones --}}
                <div class="space-y-3">
                    <flux:button
                        as="a"
                        href="{{ $this->checkoutUrl }}"
                        variant="primary"
                        class="!w-full !bg-primary !py-3.5 !rounded-xl !font-bold !text-base hover:!bg-secondary !transition-all"
                    >
                        Ir a Pagar
                    </flux:button>

                    <flux:button
                        as="a"
                        href="{{ $this->cartUrl }}"
                        variant="ghost"
                        class="!w-full !py-3 !rounded-xl !font-semibold !text-sm"
                    >
                        Ver Carrito Completo
                    </flux:button>
                </div>
            @else
                {{-- Carrito vacío --}}
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <div class="bg-slate-100 rounded-full p-6 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                    </div>
                    <flux:heading size="lg" class="!text-slate-700">Tu carrito está vacío</flux:heading>
                    <flux:subheading class="mt-2">
                        ¡Explora nuestra tienda y encuentra productos increíbles!
                    </flux:subheading>

                    <flux:modal.close>
                        <flux:button
                            as="a"
                            href="{{ $this->shopUrl }}"
                            variant="primary"
                            class="!bg-primary !px-8 !py-3 !rounded-xl !font-bold !mt-6 hover:!bg-secondary"
                        >
                            Explorar Tienda
                        </flux:button>
                    </flux:modal.close>
                </div>
            @endif
        </div>
    </flux:modal>

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