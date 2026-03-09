@php
/**
 * WooCommerce Template Override: order/order-details-item.php
 * Auto-generated from WooCommerce plugin template.
 * TODO: Personalizar con tu diseño Tailwind/Flux.
 * @version 5.2.0
 */
defined('ABSPATH') || exit;
@endphp

{{-- TODO: Personalizar este template con tu diseño --}}

<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<div class="px-6 py-6 md:px-8 group hover:bg-slate-50/50 transition-colors {{ esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ) }}">
    <div class="flex items-center gap-6">
        <!-- Product Thumbnail -->
        <div class="w-14 h-14 rounded-xl bg-white border border-slate-100 flex items-center justify-center shrink-0 overflow-hidden shadow-sm">
            @if ( $product && $product->get_image_id() )
                {!! $product->get_image('thumbnail', ['class' => 'w-full h-full object-cover']) !!}
            @else
                <flux:icon.photo variant="mini" class="text-slate-200 w-6 h-6" />
            @endif
        </div>

        <!-- Info Grid -->
        <div class="flex-1 grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <div class="md:col-span-8">
                @php
                $is_visible        = $product && $product->is_visible();
                $product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
                @endphp
                
                <div class="text-sm font-black text-slate-900 leading-tight mb-1">
                    {!! wp_kses_post( apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s" class="hover:text-primary-600 transition-colors">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible ) ) !!}
                </div>

                @php
                do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );
                wc_display_item_meta( $item );
                do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
                @endphp
            </div>

            <!-- Qty -->
            <div class="md:col-span-1 text-center hidden md:block">
                @php
                $qty          = $item->get_quantity();
                $refunded_qty = $order->get_qty_refunded_for_item( $item_id );
                @endphp
                <span class="inline-flex items-center justify-center min-w-8 h-8 rounded-lg bg-slate-100/50 text-xs font-black text-slate-700">
                    {{ $refunded_qty ? $qty - ($refunded_qty * -1) : $qty }}
                </span>
            </div>

            <!-- Subtotal -->
            <div class="md:col-span-3 text-right">
                <div class="text-base font-black text-slate-900 tabular-nums tracking-tight">
                    {!! $order->get_formatted_line_subtotal( $item ) !!}
                </div>
                <!-- Mobile Qty -->
                <div class="md:hidden mt-1">
                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Cant: {{ $qty }}</span>
                </div>
            </div>
        </div>
    </div>

    @if ( $show_purchase_note && $purchase_note )
        <div class="mt-4 ml-20 p-3 bg-primary-50 rounded-xl border border-primary-100 text-[11px] text-primary-900 leading-relaxed italic">
            {!! wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ) !!}
        </div>
    @endif
</div>
