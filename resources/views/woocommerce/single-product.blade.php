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
    <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">
        
        {{-- Left Column: Images (Large & Prominent) --}}
        <div class="w-full lg:w-3/5 space-y-6">
            {{-- Main Image --}}
            <div class="aspect-[4/5] md:aspect-[3/4] bg-slate-50 rounded-[2rem] overflow-hidden relative shadow-sm border border-slate-100 flex items-center justify-center group">
                @if($is_on_sale)
                    <div class="absolute top-6 left-6 z-10">
                        <flux:badge color="red" size="sm" class="!px-4 !py-1.5 shadow-sm !rounded-full font-black uppercase tracking-widest text-[10px]">¡Oferta!</flux:badge>
                    </div>
                @endif
                @if($main_image_url)
                    <img src="{{ $main_image_url }}" alt="{{ $product->get_name() }}" class="w-full h-full object-cover mix-blend-multiply group-hover:scale-105 transition-transform duration-700 ease-in-out">
                @else
                    <flux:icon.photo class="w-24 h-24 text-slate-200" />
                @endif
            </div>

            {{-- Gallery --}}
            @if(!empty($gallery_ids))
                <div class="grid grid-cols-4 sm:grid-cols-5 gap-3 md:gap-4">
                    @foreach($gallery_ids as $attachment_id)
                        @php $img_url = wp_get_attachment_url($attachment_id); @endphp
                        <button class="aspect-square bg-slate-50 rounded-2xl overflow-hidden shadow-sm border border-transparent hover:border-primary transition-all focus:ring-4 focus:ring-primary/20 focus:outline-none">
                            <img src="{{ $img_url }}" class="w-full h-full object-cover mix-blend-multiply">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Right Column: Sticky Product Info --}}
        <div class="w-full lg:w-2/5 flex flex-col lg:sticky lg:top-32">
            
            {{-- Breadcrumb / Meta --}}
            <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4 flex items-center gap-2">
                <flux:icon.tag variant="mini" class="w-3.5 h-3.5 opacity-50" />
                {!! strip_tags($categories) !!}
            </div>

            {{-- Title --}}
            <flux:heading size="xl" level="1" class="!text-slate-900 font-black tracking-tight mb-4 leading-none">
                {{ $product->get_name() }}
            </flux:heading>

            {{-- Price --}}
            <div class="text-3xl font-black text-primary mb-6 flex items-end gap-3 tracking-tighter mix-blend-multiply price-wrapper">
                {!! $price_html !!}
            </div>

            {{-- Vendor Details via Webkul Marketplace Hook (if applicable) --}}
            <div class="mb-6 p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-3">
                <flux:icon.building-storefront variant="solid" class="w-5 h-5 text-slate-400" />
                <div class="text-sm text-slate-600 font-medium">
                    @php do_action( 'woocommerce_product_meta_start' ); @endphp
                </div>
            </div>

            {{-- Short Description --}}
            @if($short_desc)
                <div class="prose prose-slate prose-sm max-w-none text-slate-600 mb-8 leading-relaxed">
                    {!! $short_desc !!}
                </div>
            @endif

            {{-- Add to Cart Form --}}
            <div class="mt-4 pt-8 border-t border-slate-100">
                @if ( $product->is_type('simple') )
                    <form class="cart flex flex-col sm:flex-row gap-4 mb-8" action="{{ esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ) }}" method="post" enctype='multipart/form-data'>
                        
                        {{-- Quantity Selector --}}
                        <div class="flex items-center bg-white border-2 border-slate-100 rounded-2xl h-[3.25rem] w-full sm:w-[140px] shadow-sm">
                            <button type="button" class="w-12 h-full flex items-center justify-center text-slate-400 hover:text-primary transition-colors focus:outline-none rounded-l-2xl" onclick="document.getElementById('quantity_{{ $product->get_id() }}').stepDown()">
                                <flux:icon.minus class="w-4 h-4" />
                            </button>
                            <input
                                type="number"
                                id="quantity_{{ $product->get_id() }}"
                                class="qty w-full h-full text-center bg-transparent border-none focus:ring-0 text-lg font-black text-slate-900 appearance-none pointer-events-none"
                                step="1"
                                min="1"
                                max="{{ $product->get_stock_quantity() ?: '' }}"
                                name="quantity"
                                value="1"
                                title="Qty"
                                inputmode="numeric"
                            />
                            <button type="button" class="w-12 h-full flex items-center justify-center text-slate-400 hover:text-primary transition-colors focus:outline-none rounded-r-2xl" onclick="document.getElementById('quantity_{{ $product->get_id() }}').stepUp()">
                                <flux:icon.plus class="w-4 h-4" />
                            </button>
                        </div>
                        <style>
                            input[type=number]::-webkit-inner-spin-button, 
                            input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
                        </style>

                        {{-- Submit Button --}}
                        <button type="submit" name="add-to-cart" value="{{ esc_attr( $product->get_id() ) }}" class="flex-1 bg-primary hover:bg-[#d14d15] text-white h-[3.25rem] rounded-2xl font-black text-sm uppercase tracking-wider transition-all shadow-[0_8px_16px_rgba(242,101,34,0.3)] hover:shadow-[0_12px_24px_rgba(242,101,34,0.4)] hover:-translate-y-0.5 active:scale-[0.98] active:translate-y-0 flex items-center justify-center gap-3 w-full">
                            <flux:icon.shopping-bag variant="solid" class="w-5 h-5" />
                            Agregar al Carrito
                        </button>
                    </form>
                @else
                    {{-- Variable/Other products --}}
                    <div class="mb-8">
                        @php woocommerce_template_single_add_to_cart(); @endphp
                        <style>
                            .woocommerce-variation-add-to-cart { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1.5rem; }
                            .woocommerce-variation-add-to-cart .quantity { flex-shrink: 0; }
                            .woocommerce-variation-add-to-cart button { flex-grow: 1; background: #F26522 !important; color: white !important; border-radius: 1rem !important; height: 3.25rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; border: none; padding: 0 2rem; box-shadow: 0 8px 16px rgba(242,101,34,0.3); cursor: pointer; transition: all 0.2s; }
                            .woocommerce-variation-add-to-cart button:hover { background: #d14d15 !important; transform: translateY(-2px); box-shadow: 0 12px 24px rgba(242,101,34,0.4); }
                            .woocommerce-variation-add-to-cart button:active { transform: scale(0.98) translateY(0); }
                        </style>
                    </div>
                @endif
                
                <div class="flex items-center gap-6 mt-6">
                    @if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) )
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-500">
                            <flux:icon.cube variant="solid" class="w-4 h-4 text-slate-300" />
                            <span>SKU:</span> 
                            <span class="text-slate-900">{{ ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ) }}</span>
                        </div>
                    @endif
                    @php do_action( 'woocommerce_product_meta_end' ); @endphp
                </div>
            </div>

        </div>
    </div>

    {{-- Tabs / Description Content --}}
    <div class="mt-20 lg:mt-32 max-w-4xl mx-auto">
        <flux:card class="!p-8 lg:!p-12 !rounded-[2.5rem] border !border-slate-100 shadow-sm relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-50/50 to-transparent pointer-events-none"></div>
            <div class="relative z-10">
                <flux:heading size="lg" class="!text-slate-900 font-black tracking-tight mb-8">Detalles del Producto</flux:heading>
                <div class="prose prose-slate prose-lg max-w-none prose-headings:font-black prose-headings:tracking-tight prose-a:text-primary hover:prose-a:text-[#d14d15] prose-img:rounded-2xl">
                    @php the_content(); @endphp
                </div>
            </div>
        </flux:card>
    </div>
</div>

<style>
/* Clean up default WC price styling */
.price-wrapper del { font-size: 1rem; color: #94a3b8; font-weight: 600; text-decoration: line-through; margin-right: 0.5rem; }
.price-wrapper ins { text-decoration: none; }
</style>
@endsection
