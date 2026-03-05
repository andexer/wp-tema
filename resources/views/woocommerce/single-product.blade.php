@extends('layouts.app')

@section('content')
@php
    global $product;
    if ( ! is_a( $product, 'WC_Product' ) ) {
        $product = wc_get_product( get_the_ID() );
    }

    $gallery_ids = $product->get_gallery_image_ids();
    $main_image_url = wp_get_attachment_url($product->get_image_id());
    $price_html = $product->get_price_html();
    $categories = wc_get_product_category_list($product->get_id(), ', ');
    $short_desc = apply_filters('woocommerce_short_description', $product->get_short_description());
    $is_on_sale = $product->is_on_sale();
@endphp

<div class="container mx-auto px-4 lg:px-8 py-10 lg:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
        
        {{-- Left Column: Images --}}
        <div class="space-y-4">
            {{-- Main Image --}}
            <div class="aspect-square bg-slate-50 rounded-3xl overflow-hidden relative shadow-sm border border-slate-100 flex items-center justify-center">
                @if($is_on_sale)
                    <span class="absolute top-6 left-6 bg-[#e43f3f] text-white text-[11px] font-black px-3 py-1.5 rounded-lg uppercase tracking-wider z-10 shadow-md">OFERTA</span>
                @endif
                @if($main_image_url)
                    <img src="{{ $main_image_url }}" alt="{{ $product->get_name() }}" class="w-full h-full object-cover">
                @else
                    <flux:icon name="photo" class="w-32 h-32 text-slate-200" />
                @endif
            </div>

            {{-- Gallery --}}
            @if(!empty($gallery_ids))
                <div class="grid grid-cols-4 gap-4">
                    @foreach($gallery_ids as $attachment_id)
                        @php $img_url = wp_get_attachment_url($attachment_id); @endphp
                        <button class="aspect-square bg-slate-50 rounded-xl overflow-hidden shadow-sm border border-slate-200 hover:border-primary transition-all focus:ring-2 focus:ring-primary focus:outline-none">
                            <img src="{{ $img_url }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Right Column: Product Info --}}
        <div class="flex flex-col">
            {{-- Breadcrumb / Meta --}}
            <div class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-4">
                {!! $categories !!}
            </div>

            {{-- Title --}}
            <h1 class="text-3xl lg:text-5xl font-bold text-secondary tracking-tight mb-4">{{ $product->get_name() }}</h1>

            {{-- Price --}}
            <div class="text-3xl font-bold text-primary mb-6 flex items-center gap-3">
                {!! $price_html !!}
            </div>

            {{-- Short Description --}}
            @if($short_desc)
                <div class="prose prose-slate prose-sm md:prose-base max-w-none text-slate-600 mb-8 border-y border-slate-100 py-6">
                    {!! $short_desc !!}
                </div>
            @endif

            {{-- Add to Cart Form --}}
            <div class="mt-auto">
                {{-- If simple product, native add to cart behavior wrapper --}}
                @if($product->is_type('simple'))
                    <form class="cart flex flex-col sm:flex-row gap-4 mb-8" action="{{ esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ) }}" method="post" enctype='multipart/form-data'>
                        
                        {{-- Quantity --}}
                        <div class="flex items-center bg-slate-50 border border-slate-200 rounded-xl h-14 max-w-[140px]">
                            <button type="button" class="w-12 h-full flex items-center justify-center text-slate-500 hover:text-primary transition-colors focus:outline-none" onclick="document.getElementById('quantity_{{ $product->get_id() }}').stepDown()">
                                <flux:icon name="minus" class="w-4 h-4" />
                            </button>
                            <input
                                type="number"
                                id="quantity_{{ $product->get_id() }}"
                                class="qty w-full h-full text-center bg-transparent border-none focus:ring-0 text-base font-semibold text-secondary appearance-none"
                                step="1"
                                min="1"
                                max="{{ $product->get_stock_quantity() ?: '' }}"
                                name="quantity"
                                value="1"
                                title="Qty"
                                style="-moz-appearance: textfield;"
                            />
                            <button type="button" class="w-12 h-full flex items-center justify-center text-slate-500 hover:text-primary transition-colors focus:outline-none" onclick="document.getElementById('quantity_{{ $product->get_id() }}').stepUp()">
                                <flux:icon name="plus" class="w-4 h-4" />
                            </button>
                        </div>
                        <style>
                            /* Hide arrows on number input */
                            input[type=number]::-webkit-inner-spin-button, 
                            input[type=number]::-webkit-outer-spin-button { 
                                -webkit-appearance: none; 
                                margin: 0; 
                            }
                        </style>

                        {{-- Submit Button --}}
                        <button type="submit" name="add-to-cart" value="{{ esc_attr( $product->get_id() ) }}" class="flex-1 bg-primary hover:bg-[#d14d15] text-white h-14 rounded-xl font-bold text-base transition-all shadow-md active:scale-[0.98] flex items-center justify-center gap-2">
                            <flux:icon name="shopping-bag" class="w-5 h-5" />
                            Agregar al Carrito
                        </button>
                    </form>
                @else
                    {{-- Variable/Other products hook out to default WooCommerce template --}}
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">
                        @php woocommerce_template_single_add_to_cart(); @endphp
                        <style>
                            .woocommerce-variation-add-to-cart { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1.5rem; }
                            .woocommerce-variation-add-to-cart .quantity { flex-shrink: 0; }
                            .woocommerce-variation-add-to-cart button { flex-grow: 1; background: #F26522 !important; color: white !important; border-radius: 0.75rem !important; height: 3.5rem; font-weight: bold; border: none; padding: 0 2rem; }
                            .woocommerce-variation-add-to-cart button:hover { background: #d14d15 !important; }
                        </style>
                    </div>
                @endif
                
                {{-- Product Meta info (SKU, etc) --}}
                <div class="text-sm text-slate-500 flex flex-col gap-2 mt-6">
                    @if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) )
                        <span class="sku_wrapper flex items-center gap-2">
                            <flux:icon name="cube" variant="micro" class="w-4 h-4 text-slate-400" />
                            <span class="font-medium text-slate-700">SKU:</span> 
                            <span class="sku">{{ ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ) }}</span>
                        </span>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- Tabs / Description Content --}}
    <div class="mt-20">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 lg:p-12">
            <h2 class="text-2xl font-bold text-secondary mb-8 pb-4 border-b border-slate-100">Detalles del Producto</h2>
            <div class="prose prose-slate max-w-none prose-img:rounded-xl">
                @php the_content(); @endphp
            </div>
        </div>
    </div>
</div>
@endsection
