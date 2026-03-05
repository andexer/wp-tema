<?php

use Livewire\Component;

new class extends Component
{
    public array $endpoints = [];
    public array $categories = [];
    public array $trendingProducts = [];

    public function mount(): void
    {
        $this->loadEndpoints();
        $this->loadCategories();
        $this->loadTrendingProducts();
    }

    /**
     * Carga las URLs de los endpoints principales de WooCommerce
     */
    protected function loadEndpoints(): void
    {
        $this->endpoints = [
            [
                'name'  => 'Tienda',
                'url'   => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '#',
                'icon'  => 'building-storefront',
                'desc'  => 'Todos los productos',
            ],
            [
                'name'  => 'Mi Carrito',
                'url'   => function_exists('wc_get_cart_url') ? wc_get_cart_url() : '#',
                'icon'  => 'shopping-cart',
                'desc'  => 'Ver tu carrito',
            ],
            [
                'name'  => 'Checkout',
                'url'   => function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : '#',
                'icon'  => 'credit-card',
                'desc'  => 'Finalizar compra',
            ],
            [
                'name'  => 'Mi Cuenta',
                'url'   => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : '#',
                'icon'  => 'user-circle',
                'desc'  => 'Pedidos y datos',
            ],
            [
                'name'  => 'Ofertas',
                'url'   => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') . '?on_sale=true' : '#',
                'icon'  => 'tag',
                'desc'  => 'Precios especiales',
            ],
        ];
    }

    /**
     * Carga las categorías principales de productos
     */
    protected function loadCategories(): void
    {
        if (!function_exists('get_terms')) {
            $this->categories = $this->fallbackCategories();
            return;
        }

        $terms = get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
            'parent'     => 0,
            'number'     => 8,
            'orderby'    => 'count',
            'order'      => 'DESC',
            'exclude'    => [get_option('default_product_cat', 0)], // Excluir "Uncategorized"
        ]);

        if (is_wp_error($terms) || empty($terms)) {
            $this->categories = $this->fallbackCategories();
            return;
        }

        $icons = [
            'vestuario' => 'sparkles', 'belleza' => 'sparkles', 'hogar' => 'home',
            'juguetes' => 'puzzle-piece', 'tecnologia' => 'computer-desktop', 'deportes' => 'trophy',
            'supermercado' => 'shopping-bag', 'bebes' => 'heart', 'oficina' => 'briefcase',
            'ferreteria' => 'wrench', 'escolar' => 'academic-cap',
        ];

        $this->categories = collect($terms)->map(function ($term) use ($icons) {
            $slug = sanitize_title($term->name);
            return [
                'name'  => $term->name,
                'url'   => get_term_link($term),
                'count' => $term->count,
                'icon'  => $icons[$slug] ?? 'squares-2x2',
            ];
        })->toArray();
    }

    /**
     * Carga los productos más vendidos / tendencias
     */
    protected function loadTrendingProducts(): void
    {
        if (!function_exists('wc_get_products')) {
            $this->trendingProducts = [];
            return;
        }

        $products = wc_get_products([
            'limit'    => 4,
            'status'   => 'publish',
            'orderby'  => 'meta_value_num',
            'meta_key' => 'total_sales',
            'order'    => 'DESC',
        ]);

        if (empty($products)) {
            // Fallback: últimos productos si no hay ventas
            $products = wc_get_products([
                'limit'   => 4,
                'status'  => 'publish',
                'orderby' => 'date',
                'order'   => 'DESC',
            ]);
        }

        $this->trendingProducts = collect($products)->map(function ($product) {
            return [
                'id'    => $product->get_id(),
                'name'  => $product->get_name(),
                'url'   => $product->get_permalink(),
                'price' => $product->get_price_html(),
                'image' => wp_get_attachment_url($product->get_image_id()) ?: wc_placeholder_img_src(),
            ];
        })->toArray();
    }

    protected function fallbackCategories(): array
    {
        return [
            ['name' => 'Vestuario', 'url' => '#', 'count' => 0, 'icon' => 'sparkles'],
            ['name' => 'Belleza', 'url' => '#', 'count' => 0, 'icon' => 'sparkles'],
            ['name' => 'Hogar', 'url' => '#', 'count' => 0, 'icon' => 'home'],
            ['name' => 'Tecnología', 'url' => '#', 'count' => 0, 'icon' => 'computer-desktop'],
            ['name' => 'Deportes', 'url' => '#', 'count' => 0, 'icon' => 'trophy'],
            ['name' => 'Supermercado', 'url' => '#', 'count' => 0, 'icon' => 'shopping-bag'],
        ];
    }

    public function getShopUrlProperty(): string
    {
        return function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '#';
    }
};
?>

<div
    x-data="{ open: false, timeout: null }"
    @mouseenter="clearTimeout(timeout); open = true"
    @mouseleave="timeout = setTimeout(() => open = false, 200)"
    class="relative"
>
    {{-- Trigger Button --}}
    <button
        class="flex items-center gap-1.5 text-sm font-semibold text-slate-600 hover:text-primary transition-colors py-2 group"
        @click="open = !open"
    >
        <flux:icon name="squares-2x2" variant="outline" class="w-4 h-4" />
        <span>Tienda</span>
        <flux:icon name="chevron-down" variant="micro" class="w-3 h-3 transition-transform duration-200" ::class="open ? 'rotate-180' : ''" />
    </button>

    {{-- Mega Menu Panel --}}
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="absolute top-full left-1/2 -translate-x-1/2 mt-2 w-[820px] bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden z-50"
    >
        <div class="grid grid-cols-12 divide-x divide-slate-100">

            {{-- ═══ Columna 1: Accesos Rápidos (Endpoints WooCommerce) ═══ --}}
            <div class="col-span-3 p-5">
                <flux:subheading class="!text-[9px] !uppercase !tracking-[0.2em] !text-slate-400 !font-bold mb-4">Accesos Rápidos</flux:subheading>
                <nav class="space-y-0.5">
                    @foreach($endpoints as $endpoint)
                        <a
                            href="{{ $endpoint['url'] }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-primary/5 hover:text-primary transition-all group"
                            wire:navigate
                        >
                            <div class="w-8 h-8 rounded-lg bg-slate-50 group-hover:bg-primary/10 flex items-center justify-center transition-colors shrink-0">
                                <flux:icon :name="$endpoint['icon']" variant="outline" class="w-4 h-4 text-slate-400 group-hover:text-primary transition-colors" />
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold leading-tight truncate">{{ $endpoint['name'] }}</p>
                                <p class="text-[10px] text-slate-400 leading-tight mt-0.5">{{ $endpoint['desc'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </nav>
            </div>

            {{-- ═══ Columna 2: Categorías de Productos ═══ --}}
            <div class="col-span-4 p-5">
                <flux:subheading class="!text-[9px] !uppercase !tracking-[0.2em] !text-slate-400 !font-bold mb-4">Categorías</flux:subheading>
                <div class="grid grid-cols-2 gap-1">
                    @foreach($categories as $category)
                        <a
                            href="{{ $category['url'] }}"
                            class="flex items-center gap-2.5 px-2.5 py-2 rounded-xl text-slate-600 hover:bg-primary/5 hover:text-primary transition-all group"
                            wire:navigate
                        >
                            <div class="w-7 h-7 rounded-lg bg-slate-50 group-hover:bg-primary/10 flex items-center justify-center transition-colors shrink-0">
                                <flux:icon :name="$category['icon']" variant="outline" class="w-3.5 h-3.5 text-slate-400 group-hover:text-primary transition-colors" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-semibold leading-tight truncate">{{ $category['name'] }}</p>
                                @if($category['count'] > 0)
                                    <p class="text-[9px] text-slate-400 leading-tight mt-0.5">{{ $category['count'] }} productos</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>

                <flux:separator class="my-3" />

                <a href="{{ $this->shopUrl }}" class="flex items-center gap-2 text-xs font-bold text-primary hover:text-secondary transition-colors group" wire:navigate>
                    Ver todas las categorías
                    <flux:icon name="arrow-right" variant="micro" class="w-3 h-3 transition-transform group-hover:translate-x-1" />
                </a>
            </div>

            {{-- ═══ Columna 3: Productos en Tendencia ═══ --}}
            <div class="col-span-5 p-5 bg-slate-50/50">
                <flux:subheading class="!text-[9px] !uppercase !tracking-[0.2em] !text-slate-400 !font-bold mb-4">
                    🔥 Tendencias
                </flux:subheading>

                @if(count($trendingProducts) > 0)
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($trendingProducts as $product)
                            <a
                                href="{{ $product['url'] }}"
                                class="bg-white rounded-xl overflow-hidden border border-slate-100 hover:border-primary/20 hover:shadow-md transition-all group"
                                wire:navigate
                            >
                                <div class="aspect-square overflow-hidden">
                                    <img
                                        src="{{ $product['image'] }}"
                                        alt="{{ $product['name'] }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy"
                                    />
                                </div>
                                <div class="p-2.5">
                                    <h4 class="text-xs font-semibold text-secondary line-clamp-1 group-hover:text-primary transition-colors">{{ $product['name'] }}</h4>
                                    <p class="text-xs font-bold text-primary mt-1">{!! $product['price'] !!}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <a href="{{ $this->shopUrl }}?orderby=popularity" class="flex items-center gap-2 text-xs font-bold text-primary hover:text-secondary transition-colors group mt-4" wire:navigate>
                        Ver más tendencias
                        <flux:icon name="arrow-right" variant="micro" class="w-3 h-3 transition-transform group-hover:translate-x-1" />
                    </a>
                @else
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <flux:icon name="fire" class="w-8 h-8 text-slate-300 mb-3" />
                        <p class="text-xs text-slate-400">Pronto verás productos en tendencia aquí</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
