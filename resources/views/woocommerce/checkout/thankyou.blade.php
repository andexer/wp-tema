@php
/**
 * WooCommerce Template Override: checkout/thankyou.php
 * Auto-generated from WooCommerce plugin template.
 * TODO: Personalizar con tu diseño Tailwind/Flux.
 * @version 8.1.0
 */
defined('ABSPATH') || exit;
@endphp

{{-- TODO: Personalizar este template con tu diseño --}}

@php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
@endphp<div class="woocommerce-order max-w-4xl mx-auto py-10 md:py-16 px-4">
    @if ( $order )
        @php
            do_action( 'woocommerce_before_thankyou', $order->get_id() );
            // Check if this is a main order split into sub-orders
            global $wk_mpso;
            $is_main_order_with_children = false;
            $child_orders = [];
            
            if ( function_exists('is_plugin_active') && is_plugin_active('wp-marketplace-split-order/wp-marketplace-split-order.php') && isset($wk_mpso) ) {
                $child_orders_result = $wk_mpso->wkmpso_get_child_order_ids( $order->get_id() );
                if ( ! empty( $child_orders_result ) ) {
                    $is_main_order_with_children = true;
                    $child_orders = wp_list_pluck( $child_orders_result, 'ID' );
                }
            }
        @endphp

        @if ( $order->has_status( 'failed' ) )
            <flux:card class="!p-8 !bg-red-50 !border-red-100 !rounded-3xl shadow-sm mb-10 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <flux:icon.exclamation-triangle variant="solid" class="w-8 h-8 text-red-600" />
                </div>
                <flux:heading size="lg" class="!text-red-900 font-bold mb-4">@php esc_html_e( 'Hubo un problema con el pago', 'woocommerce' ); @endphp</flux:heading>
                <p class="text-red-700/80 mb-8 px-4">@php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); @endphp</p>
                <div class="flex justify-center gap-4">
                    <flux:button href="{{ esc_url( $order->get_checkout_payment_url() ) }}" variant="primary" class="!bg-red-600 !rounded-xl !px-10">@php esc_html_e( 'Intentar de nuevo', 'woocommerce' ); @endphp</flux:button>
                </div>
            </flux:card>
        @else
            <!-- Success Header: ALWAYS show once at the top -->
            <div class="bg-white border border-slate-100 rounded-[2rem] shadow-sm overflow-hidden mb-10">
                <div class="bg-primary p-8 md:p-12 text-center relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10 pointer-events-none">
                        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"/></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-md rounded-full mb-6">
                            <flux:icon.check variant="mini" class="text-white w-6 h-6" />
                        </div>
                        <flux:heading size="xl" class="!text-white !text-3xl md:!text-4xl font-black tracking-tight mb-2">
                            @php esc_html_e( '¡Pedido Confirmado!', 'woocommerce' ); @endphp
                        </flux:heading>
                        <p class="text-white/80 font-medium text-sm">Gracias por tu compra. Tu pedido está siendo procesado.</p>
                    </div>
                </div>

                <!-- Main Order Stats Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-y md:divide-y-0 divide-slate-100">
                    <div class="p-6 md:p-8">
                        <span class="block text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Nº Pedido</span>
                        <p class="text-lg font-black text-slate-900">#{{ $order->get_order_number() }}</p>
                    </div>
                    <div class="p-6 md:p-8">
                        <span class="block text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Fecha</span>
                        <p class="text-lg font-bold text-slate-900 leading-none">{{ $order->get_date_created()->date('d/m/Y') }}</p>
                    </div>
                    <div class="p-6 md:p-8">
                        <span class="block text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Total</span>
                        <p class="text-lg font-black text-slate-900 tabular-nums">{!! $order->get_formatted_order_total() !!}</p>
                    </div>
                    <div class="p-6 md:p-8 bg-slate-50/50">
                        <span class="block text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Pago via</span>
                        <p class="text-sm font-black text-slate-700 uppercase leading-none">{!! wp_kses_post( $order->get_payment_method_title() ) !!}</p>
                    </div>
                </div>
            </div>
            
            @php 
                // We deliberately do not run the split-order suborder loop from the plugin template.
                // Instead, we just show the standard order hooks which the plugin hooks into to show sub-orders.
                // The plugin will call do_action('woocommerce_thankyou') and we style its output via CSS.
            @endphp
        @endif

        @php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); @endphp
        @php do_action( 'woocommerce_thankyou', $order->get_id() ); @endphp

    @else
        <div class="bg-white border border-slate-100 rounded-[2rem] p-12 text-center shadow-sm">
            <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <flux:icon.check-circle variant="solid" class="w-8 h-8 text-green-500" />
            </div>
            <div class="max-w-md mx-auto text-lg font-bold text-slate-600 mb-8 leading-relaxed">
                <p>Gracias por tu compra. Tu pedido ha sido recibido.</p>
            </div>
            <flux:button href="/" variant="primary" class="!px-10 !h-12 !rounded-xl font-bold">Volver a la tienda</flux:button>
        </div>
    @endif
</div>
