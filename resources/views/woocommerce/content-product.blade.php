@php
/**
 * WooCommerce Template Override: content-product.php
 * Custom Flux UI + Tailwind implementation.
 */
defined('ABSPATH') || exit;

global $product;

if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}

// Temporary remove default WC actions to avoid duplicate output
// We will output title, price, and thumbnail manually for better Tailwind control.
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
@endphp

<li <?php wc_product_class( 'group flex flex-col', $product ); ?>>
    <flux:card class="!p-0 !rounded-3xl border !border-slate-100 shadow-sm relative overflow-hidden transition-all duration-500 hover:shadow-xl hover:-translate-y-1.5 h-full flex flex-col bg-white">
        
        {{-- Product Link Wrapper (Open) --}}
        @php do_action( 'woocommerce_before_shop_loop_item' ); @endphp
        
        <a href="{{ $product->get_permalink() }}" class="block relative bg-slate-50 aspect-[4/5] overflow-hidden flex items-center justify-center">
            @if($product->is_on_sale())
                <div class="absolute top-4 left-4 z-10">
                    <flux:badge color="red" size="sm" class="!px-3 !py-1 shadow-sm !rounded-full font-black uppercase tracking-widest text-[9px]">¡Oferta!</flux:badge>
                </div>
            @endif
            
            {!! $product->get_image('woocommerce_thumbnail', ['class' => 'w-full h-full object-cover mix-blend-multiply group-hover:scale-110 transition-transform duration-700 ease-in-out']) !!}
            
            {{-- Hooks for extra badges/elements over image --}}
            @php do_action( 'woocommerce_before_shop_loop_item_title' ); @endphp
        </a>

        {{-- Content Area --}}
        <div class="p-5 md:p-6 flex flex-col flex-grow relative">
            
            {{-- Category --}}
            <div class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-2 truncate">
                {!! strip_tags(wc_get_product_category_list($product->get_id(), ', ')) !!}
            </div>
            
            {{-- Title --}}
            <a href="{{ $product->get_permalink() }}" class="block mb-2 group-hover:text-primary transition-colors">
                <flux:heading size="md" level="3" class="!text-slate-900 font-bold line-clamp-2 leading-snug">
                    {{ $product->get_name() }}
                </flux:heading>
            </a>
            
            {{-- Plugin Hooks (e.g. Vendor Name) --}}
            <div class="text-xs text-slate-500 mb-4 vendor-meta-wrapper">
                @php do_action( 'woocommerce_shop_loop_item_title' ); @endphp
                @php do_action( 'woocommerce_after_shop_loop_item_title' ); @endphp
            </div>

            {{-- Price & Add to Cart --}}
            <div class="mt-auto pt-5 border-t border-slate-50 flex items-center justify-between gap-3 relative z-20">
                <div class="text-lg font-black text-primary tracking-tighter price-wrapper truncate">
                    {!! $product->get_price_html() !!}
                </div>
                
                {{-- The Add to Cart Button Hook --}}
                <div class="flex-shrink-0 loop-add-to-cart-wrapper">
                    @php do_action( 'woocommerce_after_shop_loop_item' ); @endphp
                </div>
            </div>
        </div>
    </flux:card>
</li>

@php
// Restore actions so they don't affect other loops globally if not needed
add_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
@endphp
