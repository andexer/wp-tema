@php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
@endphp

@php
do_action('woocommerce_before_cart');
@endphp

<div class="max-w-[1400px] mx-auto px-2 sm:px-4 lg:px-8 py-6 md:py-12">

    <div class="mb-6 md:mb-10 text-center relative">
        <div class="inline-block px-3 py-1 mb-2 rounded-full bg-primary-50 text-primary-600 font-bold text-[9px] md:text-xs uppercase tracking-[0.2em]">
            {{ __('Checkout Process', 'woocommerce') }}
        </div>
        <flux:heading size="xl" class="!text-xl md:!text-3xl lg:!text-4xl font-black tracking-tight text-slate-900 drop-shadow-sm">
            {{ __('Your Shopping Bag', 'woocommerce') }}
        </flux:heading>
        <div class="mt-1 md:mt-3 text-slate-500 text-xs md:text-sm font-medium max-w-lg mx-auto px-2">
            {{ __('Review your items and proceed to secure checkout.', 'detodo24') }}
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-start">
        
        {{-- ==================== LEFT COLUMN: CART ITEMS ==================== --}}
        <div class="w-full lg:w-[55%]">
            <form class="woocommerce-cart-form" action="{{ esc_url( wc_get_cart_url() ) }}" method="post">
                @php
                do_action('woocommerce_before_cart_table');
                @endphp

                <div class="space-y-6">
                    @php
                    do_action('woocommerce_before_cart_contents');
                    @endphp

                    @foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item )
                        @php
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                        $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                        @endphp

                        @if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) )
                            @php
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            @endphp

                            <div class="woocommerce-cart-form__cart-item {{ esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item group', $cart_item, $cart_item_key ) ) }}">
                                <flux:card class="p-3 md:p-5 relative overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-primary-500/5 hover:-translate-y-0.5 bg-white/70 backdrop-blur-xl border-none ring-1 ring-slate-200/50">
                                    <div class="flex flex-row md:items-center gap-3 md:gap-6">
                                        
                                        {{-- THUMBNAIL --}}
                                        <div class="shrink-0 relative group/thumb">
                                            @php
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_gallery_thumbnail', ['class' => 'w-14 h-14 md:w-24 md:h-24 object-cover rounded-xl md:rounded-2xl shadow-sm md:shadow-md border border-slate-100 transition-transform duration-500 group-hover/thumb:scale-105']), $cart_item, $cart_item_key );
                                            @endphp
                                            
                                            @if ( ! $product_permalink )
                                                {!! $thumbnail !!}
                                            @else
                                                <a href="{{ esc_url( $product_permalink ) }}" wire:navigate class="block relative overflow-hidden rounded-3xl">
                                                    {!! $thumbnail !!}
                                                    <div class="absolute inset-0 bg-primary-600/0 group-hover/thumb:bg-primary-600/10 transition-colors duration-500"></div>
                                                </a>
                                            @endif

                                            {{-- Remove Button Overlay (Desktop Only) --}}
                                            @php
                                            $remove_url = esc_url( wc_get_cart_remove_url( $cart_item_key ) );
                                            $remove_label = esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) );
                                            @endphp
                                            <a href="{{ $remove_url }}" 
                                               class="absolute -top-1.5 -left-1.5 md:-top-2 md:-left-2 bg-white text-red-500 p-1 md:p-1.5 rounded-full shadow-md md:opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-red-50 hover:scale-110 z-20 border border-slate-100"
                                               aria-label="{{ $remove_label }}" 
                                               data-product_id="{{ esc_attr( $product_id ) }}" 
                                               data-product_sku="{{ esc_attr( $_product->get_sku() ) }}">
                                               <flux:icon.x-mark variant="mini" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                            </a>
                                        </div>

                                        {{-- DETAILS --}}
                                        <div class="flex-grow flex flex-col md:flex-row md:items-center justify-between gap-3 md:gap-4 min-w-0">
                                            <div class="space-y-0.5 md:space-y-1">
                                                @if ( ! $product_permalink )
                                                    <span class="block font-black text-slate-900 text-sm md:text-base tracking-tight leading-tight truncate">{!! wp_kses_post( $product_name ) !!}</span>
                                                @else
                                                    <a href="{{ esc_url( $product_permalink ) }}" wire:navigate class="block font-black text-slate-900 text-sm md:text-base tracking-tight leading-tight hover:text-primary-600 transition-colors duration-300 truncate">
                                                        {!! wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) !!}
                                                    </a>
                                                @endif

                                                @php
                                                do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);
                                                @endphp

                                                <div class="text-xs font-bold uppercase tracking-widest text-slate-400">
                                                    {!! wc_get_formatted_cart_item_data( $cart_item ) !!}
                                                </div>

                                                @if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
                                                    <div class="mt-4">
                                                        <flux:badge color="amber" size="sm" variant="subtle" class="font-black px-3 py-1 rounded-full uppercase tracking-tighter">
                                                            {!! wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', esc_html__( 'Available on backorder', 'woocommerce' ), $product_id ) ) !!}
                                                        </flux:badge>
                                                    </div>
                                                @endif

                                                <div class="hidden sm:block text-slate-500 font-medium text-[10px] md:text-xs md:max-w-xs line-clamp-1">
                                                    {!! $_product->get_short_description() ?: __('Selected item for you.', 'detodo24') !!}
                                                </div>
                                            </div>

                                            {{-- PRICE & QUANTITY --}}
                                            <div class="flex flex-col-reverse sm:flex-col items-start sm:items-end justify-between gap-2 mt-1 md:mt-0 border-slate-100 sm:border-l sm:pl-4 bg-slate-50/30 sm:bg-transparent -mx-2 sm:mx-0 p-2 sm:p-0 rounded-lg sm:rounded-none">
                                                <div class="text-left sm:text-right w-full sm:w-auto flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-start">
                                                    <div class="text-[9px] md:text-[10px] font-bold text-slate-400 uppercase tracking-widest sm:mb-0.5">{{ __('Subtotal', 'woocommerce') }}</div>
                                                    <div class="text-base md:text-xl font-bold text-primary-600 tracking-tighter ml-auto sm:ml-0">
                                                        {!! apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) !!}
                                                    </div>
                                                </div>

                                                <div class="flex items-center bg-white sm:bg-slate-100/50 p-1 rounded-lg md:rounded-xl ring-1 ring-slate-200/50 shadow-inner w-full sm:w-auto justify-center">
                                                    @php
                                                    if ( $_product->is_sold_individually() ) {
                                                        $min_quantity = 1;
                                                        $max_quantity = 1;
                                                    } else {
                                                        $min_quantity = 0;
                                                        $max_quantity = $_product->get_max_purchase_quantity();
                                                    }

                                                    $product_quantity = woocommerce_quantity_input(
                                                        array(
                                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                                            'input_value'  => $cart_item['quantity'],
                                                            'max_value'    => $max_quantity,
                                                            'min_value'    => $min_quantity,
                                                            'product_name' => $product_name,
                                                            'classes'      => ['w-full', 'sm:w-12', 'md:w-10', 'text-center', 'font-black', 'bg-transparent', 'border-none', 'p-0', 'text-xs', 'md:text-sm', 'focus:ring-0']
                                                        ),
                                                        $_product,
                                                        false
                                                    );
                                                    @endphp

                                                    <div class="w-full flex justify-center">
                                                        {!! apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Bottom Accents --}}
                                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-primary-500/10 to-transparent"></div>
                                </flux:card>
                            </div>
                        @endif
                    @endforeach

                    @php
                    do_action('woocommerce_cart_contents');
                    @endphp

                    {{-- ACTION BAR (COUPON & UPDATE) --}}
                    <div class="pt-3 md:pt-6 w-full">
                        <div class="p-3 md:p-5 bg-slate-50/50 rounded-xl md:rounded-2xl border-none ring-1 ring-slate-200/40">
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-3 md:gap-6 min-w-0">
                                
                                @if ( wc_coupons_enabled() )
                                    <div class="coupon flex flex-row w-full sm:w-auto gap-2 items-end">
                                        <div class="flex-grow">
                                            <flux:input 
                                                label="{{ __('Coupon', 'woocommerce') }}"
                                                name="coupon_code" 
                                                id="coupon_code" 
                                                value="" 
                                                placeholder="{{ esc_attr__( 'CODE', 'detodo24' ) }}"
                                                class="w-full sm:min-w-[140px]"
                                                variant="outline"
                                                size="sm"
                                            />
                                        </div>
                                        <button type="submit" name="apply_coupon" value="{{ esc_attr__('Apply', 'woocommerce') }}" class="mb-[1px] h-8 md:h-9 px-4 font-bold bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-all text-[11px] md:text-xs tracking-wide">
                                            {{ __('Apply', 'woocommerce') }}
                                        </button>
                                    </div>
                                @endif

                                <div class="flex gap-3 w-full sm:w-auto mt-1 sm:mt-0 min-w-0 justify-end items-end">
                                    <flux:button type="submit" variant="primary" class="w-full sm:w-auto mt-1 sm:mt-0" name="update_cart" value="{{ esc_attr__('Update Cart', 'woocommerce') }}">
                                        {{ __('Update Cart', 'woocommerce') }}
                                    </flux:button>

                                    @php
                                    do_action('woocommerce_cart_actions');
                                    wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce');
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                    do_action('woocommerce_after_cart_contents');
                    @endphp
                </div>

                @php
                do_action('woocommerce_after_cart_table');
                @endphp
            </form>
        </div>


        {{-- ==================== RIGHT COLUMN: TOTALS ==================== --}}
        <div class="w-full lg:w-[45%]">
            <div class="cart-collaterals sticky top-32">
                @php
                do_action('woocommerce_before_cart_collaterals');
                @endphp
                
                {{-- Totals will be loaded here via woo defaults or custom overrides --}}
                <div class="cart-totals-container">
                    @php
                    do_action('woocommerce_cart_collaterals');
                    @endphp
                </div>
            </div>
        </div>

    </div>

    @php
    do_action('woocommerce_after_cart');
    @endphp
</div>

<style>
    /* Luxury Quantity Input overrides */
    .woocommerce-cart-form__cart-item input[type="number"]::-webkit-inner-spin-button,
    .woocommerce-cart-form__cart-item input[type="number"]::-webkit-outer-spin-button {
        /* Keep them for native function but we might style them or use buttons later */
    }
    .woocommerce-cart-form__cart-item .quantity {
        display: flex;
        align-items: center;
    }
</style>
