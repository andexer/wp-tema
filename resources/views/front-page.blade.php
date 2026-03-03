@extends('layouts.app')

@section('content')
    <main class="py-8 space-y-10">
        {{-- Hero Banner Slider --}}
        <livewire:hero-banner />

        <div class="container mx-auto px-4 lg:px-8 space-y-10">
            {{-- Tiendas Destacadas --}}
            <livewire:featured-stores />

            {{-- Productos Recomendados --}}
            <livewire:product-grid
                title="Productos Recomendados"
                source="featured"
            />

            {{-- Showcase de Tiendas (4 columnas, aspect 4/5) --}}
            <livewire:store-showcase
                title="Lo que quieres, cuando lo quieres"
                aspect-ratio="4/5"
            />

            {{-- Banner Promo - Envío Gratis --}}
            <livewire:promo-banner
                icon="truck"
                text="Envío gratis en miles de productos seleccionados"
                subtext="Por tiempo limitado"
                cta-label="VER PRODUCTOS"
                cta-url="#"
                bg-color="primary"
            />

            {{-- Más Productos --}}
            <livewire:product-grid
                title="Productos en Oferta"
                source="sale"
            />

            {{-- Cargar Más --}}
            <livewire:load-more-button />

            {{-- Showcase de Tiendas (3 columnas, aspect 16/9) --}}
            <livewire:store-showcase
                title=""
                aspect-ratio="16/9"
            />

            {{-- Banner Promo - Ofertas Bancarias --}}
            <livewire:promo-banner
                icon="credit-card"
                text="Aprovecha nuestras ofertas bancarias — Hasta 12 cuotas sin interés"
                cta-label="SABER MÁS"
                cta-url="#"
                bg-color="brand-orange"
            />
        </div>
    </main>
@endsection
