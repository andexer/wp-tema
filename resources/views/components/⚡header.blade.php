<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public int $cartCount = 0;
    public array $cartItems = [];
    public string $cartTotal = '';

    // Mega Menu data
    public array $megaEndpoints = [];
    public array $megaCategories = [];
    public array $megaTrending = [];

    public function mount(): void
    {
        $this->refreshCart();
        $this->loadMegaMenuData();
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

    protected function loadMegaMenuData(): void
    {
        // 1. WooCommerce Endpoints
        $this->megaEndpoints = [
            ['name' => 'Tienda', 'url' => $this->shopUrl, 'icon' => 'building-storefront', 'desc' => 'Todos los productos'],
            ['name' => 'Mi Carrito', 'url' => $this->cartUrl, 'icon' => 'shopping-cart', 'desc' => 'Ver tu carrito'],
            ['name' => 'Checkout', 'url' => $this->checkoutUrl, 'icon' => 'credit-card', 'desc' => 'Finalizar compra'],
            ['name' => 'Mi Cuenta', 'url' => $this->accountUrl, 'icon' => 'user-circle', 'desc' => 'Pedidos y datos'],
            ['name' => 'Ofertas', 'url' => $this->shopUrl . '?on_sale=true', 'icon' => 'tag', 'desc' => 'Precios especiales'],
        ];

        // 2. Product Categories
        if (function_exists('get_terms')) {
            $terms = get_terms([
                'taxonomy'   => 'product_cat',
                'hide_empty' => true,
                'parent'     => 0,
                'number'     => 8,
                'orderby'    => 'count',
                'order'      => 'DESC',
                'exclude'    => [get_option('default_product_cat', 0)],
            ]);

            if (!is_wp_error($terms) && !empty($terms)) {
                $this->megaCategories = collect($terms)->map(fn($t) => [
                    'name'  => $t->name,
                    'url'   => get_term_link($t),
                    'count' => $t->count,
                ])->toArray();
            }
        }

        if (empty($this->megaCategories)) {
            $this->megaCategories = [
                ['name' => 'Vestuario', 'url' => '#', 'count' => 0],
                ['name' => 'Belleza', 'url' => '#', 'count' => 0],
                ['name' => 'Hogar', 'url' => '#', 'count' => 0],
                ['name' => 'Tecnología', 'url' => '#', 'count' => 0],
                ['name' => 'Deportes', 'url' => '#', 'count' => 0],
                ['name' => 'Supermercado', 'url' => '#', 'count' => 0],
            ];
        }

        // 3. Trending Products
        if (function_exists('wc_get_products')) {
            $products = wc_get_products([
                'limit'    => 4,
                'status'   => 'publish',
                'orderby'  => 'meta_value_num',
                'meta_key' => 'total_sales',
                'order'    => 'DESC',
            ]);

            if (empty($products)) {
                $products = wc_get_products(['limit' => 4, 'status' => 'publish', 'orderby' => 'date', 'order' => 'DESC']);
            }

            $this->megaTrending = collect($products)->map(fn($p) => [
                'name'  => $p->get_name(),
                'url'   => $p->get_permalink(),
                'price' => $p->get_price_html(),
                'image' => wp_get_attachment_url($p->get_image_id()) ?: wc_placeholder_img_src(),
            ])->toArray();
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

<div x-data="{ megaOpen: false, megaTimeout: null }">
    {{-- ═══ Header Principal ═══ --}}
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50 h-16 md:h-20 flex items-center">
        <div class="container mx-auto px-3 sm:px-4 lg:px-8 flex items-center justify-between gap-3 sm:gap-6">

            <a href="{{ $this->homeUrl }}" class="flex items-center gap-1.5 sm:gap-3 shrink-0" wire:navigate>
                <div class="bg-primary p-1.5 sm:p-2 rounded-lg flex items-center justify-center">
                    <flux:icon.shopping-bag class="w-5 h-5 sm:w-6 sm:h-6 text-white" />
                </div>
                <span class="text-base sm:text-2xl font-bold tracking-tight text-secondary truncate max-w-[120px] xs:max-w-[150px] sm:max-w-none">{{ $this->siteName }}</span>
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
            <nav class="hidden lg:flex items-center gap-6 text-sm font-semibold text-slate-600">
                <button
                    @mouseenter="clearTimeout(megaTimeout); megaOpen = true"
                    @click="megaOpen = !megaOpen"
                    class="flex items-center gap-1.5 hover:text-primary transition-colors py-2"
                    :class="megaOpen ? 'text-primary' : ''"
                >
                    <span>Tienda</span>
                    <flux:icon name="chevron-down" variant="micro" class="w-3 h-3 transition-transform duration-200" ::class="megaOpen ? 'rotate-180' : ''" />
                </button>
                <a class="hover:text-primary transition-colors py-2" href="#">Calculadora de Envío</a>
                <a class="hover:text-primary transition-colors py-2" href="#">Rastrea tu Paquete</a>
            </nav>

            {{-- Acciones --}}
            <div class="flex items-center gap-0.5 sm:gap-2">
                {{-- Botón búsqueda móvil --}}
                <flux:button variant="ghost" icon="magnifying-glass" class="md:hidden !text-slate-700 !px-2" />

                {{-- Carrito - Modal Trigger --}}
                <flux:modal.trigger name="cart-flyout">
                    <button class="relative p-2 hover:bg-slate-100 rounded-full transition-colors flex items-center justify-center">
                        <flux:icon.shopping-cart class="w-5 h-5 sm:w-6 sm:h-6 text-slate-700" />
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-primary text-white text-[9px] sm:text-[10px] w-4 h-4 sm:w-5 sm:h-5 rounded-full flex items-center justify-center font-bold">{{ $cartCount }}</span>
                        @endif
                    </button>
                </flux:modal.trigger>

                {{-- Usuario --}}
                <a href="{{ $this->accountUrl }}" class="p-2 hover:bg-slate-100 rounded-full transition-colors flex items-center justify-center" wire:navigate>
                    <flux:icon.user class="w-5 h-5 sm:w-6 sm:h-6 text-slate-700" />
                </a>

                {{-- Menú hamburguesa móvil --}}
                <flux:button variant="ghost" icon="bars-3" class="lg:hidden !text-slate-700 !px-2" x-on:click="$dispatch('toggle-mobile-menu')" />
            </div>
        </div>
    </header>

    {{-- ═══ MEGA MENU PANEL — Full Width Below Header ═══ --}}
    <div
        x-show="megaOpen"
        x-cloak
        @mouseleave="megaTimeout = setTimeout(() => megaOpen = false, 300)"
        @mouseenter="clearTimeout(megaTimeout)"
        class="hidden lg:block absolute left-0 right-0 z-40"
        style="top: 5rem;"
    >
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-black/20" style="top: 5rem;" @click="megaOpen = false"></div>

        {{-- Panel --}}
        <div
            x-show="megaOpen"
            x-transition:enter="transition ease-out duration-250"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="relative bg-white border-b border-slate-200 shadow-2xl"
        >
            <div class="container mx-auto px-4 lg:px-8 py-6">
                <div class="grid grid-cols-12 gap-6">

                    {{-- Col 1: Accesos Rápidos (Endpoints WooCommerce) --}}
                    <div class="col-span-3">
                        <p class="text-[10px] uppercase tracking-[0.15em] text-slate-400 font-bold mb-3 px-2">Accesos Rápidos</p>
                        <nav class="space-y-0.5">
                            @foreach($megaEndpoints as $ep)
                                <a href="{{ $ep['url'] }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-primary/5 hover:text-primary transition-all group" wire:navigate @click="megaOpen = false">
                                    <div class="w-9 h-9 rounded-xl bg-slate-50 group-hover:bg-primary/10 flex items-center justify-center transition-colors shrink-0">
                                        <flux:icon :name="$ep['icon']" variant="outline" class="w-4.5 h-4.5 text-slate-400 group-hover:text-primary transition-colors" />
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[13px] font-semibold leading-tight">{{ $ep['name'] }}</p>
                                        <p class="text-[10px] text-slate-400 leading-tight mt-0.5">{{ $ep['desc'] }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </nav>
                    </div>

                    {{-- Col 2: Categorías de Productos --}}
                    <div class="col-span-4 border-x border-slate-100 px-6">
                        <p class="text-[10px] uppercase tracking-[0.15em] text-slate-400 font-bold mb-3 px-2">Categorías</p>
                        <div class="grid grid-cols-2 gap-x-2 gap-y-0.5">
                            @foreach($megaCategories as $cat)
                                <a href="{{ $cat['url'] }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-slate-600 hover:bg-primary/5 hover:text-primary transition-all group" wire:navigate @click="megaOpen = false">
                                    <span class="text-[13px] font-medium truncate">{{ $cat['name'] }}</span>
                                    @if($cat['count'] > 0)
                                        <span class="text-[10px] bg-slate-100 group-hover:bg-primary/10 text-slate-400 group-hover:text-primary px-1.5 py-0.5 rounded-full font-medium transition-colors shrink-0 ml-1">{{ $cat['count'] }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-3 pt-3 border-t border-slate-100 px-2">
                            <a href="{{ $this->shopUrl }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary hover:text-secondary transition-colors group" wire:navigate @click="megaOpen = false">
                                Ver todas las categorías
                                <flux:icon name="arrow-right" variant="micro" class="w-3 h-3 transition-transform group-hover:translate-x-1" />
                            </a>
                        </div>
                    </div>

                    {{-- Col 3: Productos en Tendencia --}}
                    <div class="col-span-5">
                        <p class="text-[10px] uppercase tracking-[0.15em] text-slate-400 font-bold mb-3 px-2">🔥 Tendencias</p>
                        @if(count($megaTrending) > 0)
                            <div class="grid grid-cols-4 gap-3">
                                @foreach($megaTrending as $prod)
                                    <a href="{{ $prod['url'] }}" class="bg-slate-50 rounded-xl overflow-hidden hover:shadow-lg transition-all group border border-slate-100 hover:border-primary/20" wire:navigate @click="megaOpen = false">
                                        <div class="aspect-square overflow-hidden">
                                            <img src="{{ $prod['image'] }}" alt="{{ $prod['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                                        </div>
                                        <div class="p-2">
                                            <h4 class="text-[11px] font-semibold text-secondary line-clamp-1 group-hover:text-primary transition-colors">{{ $prod['name'] }}</h4>
                                            <p class="text-[11px] font-bold text-primary mt-0.5">{!! $prod['price'] !!}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-8 text-center">
                                <flux:icon name="fire" class="w-8 h-8 text-slate-200 mb-2" />
                                <p class="text-xs text-slate-400">Productos en tendencia pronto</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

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
                        class="!w-full !bg-primary !py-3.5 !rounded-xl !font-bold !text-base hover:!bg-[#d14d15] !transition-all"
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
                        <flux:icon name="shopping-cart" class="w-12 h-12 text-slate-400" />
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
                            class="!bg-primary !px-8 !py-3 !rounded-xl !font-bold !mt-6 hover:!bg-[#d14d15]"
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
                    <a href="{{ $this->shopUrl }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-semibold hover:bg-slate-100 hover:text-primary transition-colors" wire:navigate>
                        <flux:icon name="building-storefront" class="w-5 h-5 text-primary" />
                        Tienda
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-semibold hover:bg-slate-100 hover:text-primary transition-colors">
                        <flux:icon name="calculator" class="w-5 h-5 text-slate-400" />
                        Calculadora de Envío
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-semibold hover:bg-slate-100 hover:text-primary transition-colors">
                        <flux:icon name="map-pin" class="w-5 h-5 text-slate-400" />
                        Rastrea tu Paquete
                    </a>
                </nav>

                <flux:separator />

                <div class="space-y-1">
                    <a href="{{ $this->cartUrl }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-semibold hover:bg-slate-100 hover:text-primary transition-colors" wire:navigate>
                        <flux:icon name="shopping-cart" class="w-5 h-5" />
                        Mi Carrito
                        @if($cartCount > 0)
                            <flux:badge size="sm" color="accent">{{ $cartCount }}</flux:badge>
                        @endif
                    </a>
                    <a href="{{ $this->checkoutUrl }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-semibold hover:bg-slate-100 hover:text-primary transition-colors" wire:navigate>
                        <flux:icon name="credit-card" class="w-5 h-5" />
                        Checkout
                    </a>
                    <a href="{{ $this->accountUrl }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-semibold hover:bg-slate-100 hover:text-primary transition-colors" wire:navigate>
                        <flux:icon name="user" class="w-5 h-5" />
                        Mi Cuenta
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>