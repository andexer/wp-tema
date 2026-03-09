@php
/**
 * WooCommerce Template Override: order/order-details-customer.php
 * Auto-generated from WooCommerce plugin template.
 * TODO: Personalizar con tu diseño Tailwind/Flux.
 * @version 8.7.0
 */
defined('ABSPATH') || exit;
@endphp

{{-- TODO: Personalizar este template con tu diseño --}}

<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details mt-10 md:mt-16">
    <flux:heading size="xl" class="!text-slate-900 font-black tracking-tight mb-8">
        @php esc_html_e( 'Detalles de Entrega', 'woocommerce' ); @endphp
    </flux:heading>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Billing Card -->
        <flux:card class="!p-8 !rounded-[2rem] border !border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-white opacity-50 z-0 pointer-events-none"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-slate-100/80 flex items-center justify-center">
                        <flux:icon.document-text variant="solid" class="text-slate-500 w-5 h-5" />
                    </div>
                    <span class="text-xs font-black uppercase tracking-widest text-slate-400">@php esc_html_e( 'Facturación', 'woocommerce' ); @endphp</span>
                </div>
                
                <div class="text-slate-900 font-bold leading-relaxed text-sm mb-6">
                    {!! wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) ) ) !!}
                </div>

                <div class="space-y-3">
                    @if ( $order->get_billing_phone() )
                        <div class="flex items-center gap-3 text-sm font-bold text-slate-600">
                            <flux:icon.phone variant="mini" class="w-4 h-4 text-slate-400" />
                            <span class="tabular-nums">{{ $order->get_billing_phone() }}</span>
                        </div>
                    @endif

                    @if ( $order->get_billing_email() )
                        <div class="flex items-center gap-3 text-sm font-bold text-slate-600 break-all">
                            <flux:icon.envelope variant="mini" class="w-4 h-4 text-slate-400" />
                            <span>{{ $order->get_billing_email() }}</span>
                        </div>
                    @endif
                </div>

                @php do_action( 'woocommerce_order_details_after_customer_address', 'billing', $order ); @endphp
            </div>
        </flux:card>

        <!-- Shipping Card -->
        @if ( $show_shipping )
            <flux:card class="!p-8 !rounded-[2rem] border !border-primary/20 shadow-sm relative overflow-hidden group bg-primary/5">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-50 z-0 pointer-events-none"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-2xl bg-primary/20 flex items-center justify-center">
                            <flux:icon.truck variant="solid" class="text-primary w-5 h-5" />
                        </div>
                        <span class="text-xs font-black uppercase tracking-widest text-primary/80">@php esc_html_e( 'Dirección de Envío', 'woocommerce' ); @endphp</span>
                    </div>

                    <div class="text-slate-900 font-bold leading-relaxed text-sm mb-6">
                        {!! wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) ) !!}
                    </div>

                    @if ( $order->get_shipping_phone() )
                        <div class="flex items-center gap-3 text-sm font-bold text-slate-600">
                            <flux:icon.phone variant="mini" class="w-4 h-4 text-primary/60" />
                            <span class="tabular-nums">{{ $order->get_shipping_phone() }}</span>
                        </div>
                    @endif

                    @php do_action( 'woocommerce_order_details_after_customer_address', 'shipping', $order ); @endphp
                </div>
            </flux:card>
        @endif
    </div>

    @php do_action( 'woocommerce_order_details_after_customer_details', $order ); @endphp
</section>
