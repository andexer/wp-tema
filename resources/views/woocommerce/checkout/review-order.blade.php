@php
/**
 * WooCommerce Template Override: checkout/review-order.php
 * Premium High-Density Review Order
 */
defined( 'ABSPATH' ) || exit;
@endphp

<div class="woocommerce-checkout-review-order-inner space-y-6">
    {{-- Product List --}}
    <div class="space-y-4">
        @php do_action( 'woocommerce_review_order_before_cart_contents' ); @endphp

        @foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item )
            @php
                $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            @endphp

            @if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) )
                <div class="flex items-start gap-4 group/item">
                    {{-- Thumbnail (Small) --}}
                    <div class="w-12 h-12 rounded-lg overflow-hidden bg-slate-50 border border-slate-100 flex-shrink-0">
                        {!! $_product->get_image('thumbnail', ['class' => 'w-full h-full object-cover']) !!}
                    </div>

                    {{-- Product Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-4">
                            <div class="text-sm font-black text-slate-900 leading-tight truncate-two-lines">
                                {!! wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) !!}
                            </div>
                            <div class="text-sm font-black text-slate-900 tabular-nums">
                                {!! apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) !!}
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-1 mt-1">
                            <div class="flex items-center gap-2">
                                <flux:badge size="sm" variant="pill" class="!bg-slate-100 !text-slate-600 !border-slate-200 !text-[9px] !py-0 !px-1.5 font-black">
                                    {{ sprintf( 'QTY: %s', $cart_item['quantity'] ) }}
                                </flux:badge>
                                
                                {{-- Meta Data --}}
                                <div class="text-[10px] text-slate-400 font-medium truncate">
                                    {!! wc_get_formatted_cart_item_data( $cart_item ) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        @php do_action( 'woocommerce_review_order_after_cart_contents' ); @endphp
    </div>

    {{-- Totals Section --}}
    <div class="pt-6 mt-6 border-t border-slate-100 space-y-3">
        <flux:subheading class="flex justify-between items-center !text-slate-500 !font-bold uppercase tracking-widest !text-[10px]">
            <span>{{ __('Subtotal', 'woocommerce') }}</span>
            <span class="!text-slate-900 !font-black tabular-nums">@php wc_cart_totals_subtotal_html(); @endphp</span>
        </flux:subheading>

        @foreach ( WC()->cart->get_coupons() as $code => $coupon )
            <div class="flex justify-between items-center text-sm !text-green-600">
                <span class="font-black text-[10px] uppercase tracking-widest flex items-center gap-1">
                    <flux:icon.tag variant="mini" class="w-3 h-3" />
                    @php wc_cart_totals_coupon_label( $coupon ); @endphp
                </span>
                <span class="font-black tabular-nums">@php wc_cart_totals_coupon_html( $coupon ); @endphp</span>
            </div>
        @endforeach

        @if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() )
            <div class="py-3 border-y border-slate-50 my-3">
                @php do_action( 'woocommerce_review_order_before_shipping' ); @endphp
                @php wc_cart_totals_shipping_html(); @endphp
                @php do_action( 'woocommerce_review_order_after_shipping' ); @endphp
            </div>
        @endif

        @foreach ( WC()->cart->get_fees() as $fee )
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-500 font-bold uppercase tracking-widest text-[10px]">{{ $fee->name }}</span>
                <span class="text-slate-900 font-black tabular-nums">@php wc_cart_totals_fee_html( $fee ); @endphp</span>
            </div>
        @endforeach

        @if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() )
            @if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) )
                @foreach ( WC()->cart->get_tax_totals() as $code => $tax )
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500 font-bold uppercase tracking-widest text-[10px]">{{ $tax->label }}</span>
                        <span class="text-slate-900 font-black tabular-nums">{!! wp_kses_post( $tax->formatted_amount ) !!}</span>
                    </div>
                @endforeach
            @else
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-500 font-bold uppercase tracking-widest text-[10px]">{{ WC()->countries->tax_or_vat() }}</span>
                    <span class="text-slate-900 font-black tabular-nums">@php wc_cart_totals_taxes_total_html(); @endphp</span>
                </div>
            @endif
        @endif

        @php do_action( 'woocommerce_review_order_before_order_total' ); @endphp

        <div class="flex justify-between items-center pt-4 mt-2 border-t-2 border-slate-900">
            <span class="text-base font-black text-slate-900 uppercase tracking-tighter">{{ __('Total', 'woocommerce') }}</span>
            <span class="text-2xl font-black text-slate-900 tabular-nums leading-none">@php wc_cart_totals_order_total_html(); @endphp</span>
        </div>

        @php do_action( 'woocommerce_review_order_after_order_total' ); @endphp
    </div>
</div>

