@php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
@endphp

<div class="cart_totals {{ ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : '' }} p-0 relative group">
    
    {{-- Decorative Background Accents --}}
    <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-500/5 rounded-full blur-3xl pointer-events-none transition-transform duration-1000 group-hover:scale-150"></div>
    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-orange-500/5 rounded-full blur-3xl pointer-events-none transition-transform duration-1000 group-hover:scale-150 delay-200"></div>

	@php
    do_action( 'woocommerce_before_cart_totals' );
    @endphp

    <div class="p-3.5 sm:p-5 md:p-6 pb-5 sm:pb-6 md:pb-8 relative overflow-hidden bg-transparent mb-4 md:mb-0">
        
        {{-- Luxury Gradient Border --}}
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary-600 to-orange-500 opacity-80"></div>

        <div class="relative z-10">
            <flux:heading size="lg" class="!text-lg md:!text-2xl font-black tracking-tight text-slate-900 mb-3 md:mb-6 flex items-center gap-2 md:gap-3">
                {{ __('Summary', 'woocommerce') }}
                <div class="h-px flex-grow bg-slate-100"></div>
            </flux:heading>

            <div class="space-y-6">
                <flux:table class="!border-none w-full">
                    <flux:table.rows>
                        {{-- SUBTOTAL --}}
                        <flux:table.row class="!border-none">
                            <flux:table.cell class="py-1.5 md:py-2.5 pl-0 align-middle">
                                <span class="text-[10px] md:text-xs font-bold uppercase tracking-[0.2em] text-slate-400">{{ __('Subtotal', 'woocommerce') }}</span>
                            </flux:table.cell>
                            <flux:table.cell align="end" class="py-1.5 md:py-2.5 pr-0 align-middle" data-title="{{ esc_attr__( 'Subtotal', 'woocommerce' ) }}">
                                <span class="text-sm md:text-base font-bold text-slate-800 tracking-tight">{!! wc_cart_totals_subtotal_html() !!}</span>
                            </flux:table.cell>
                        </flux:table.row>

                        {{-- COUPONS --}}
                        @foreach ( WC()->cart->get_coupons() as $code => $coupon )
                            <flux:table.row class="cart-discount coupon-{{ esc_attr( sanitize_title( $code ) ) }} !border-none">
                                <flux:table.cell class="py-1.5 md:py-2.5 pl-0 align-middle">
                                    <span class="text-[10px] md:text-xs font-bold uppercase tracking-[0.2em] text-primary-500">{{ wc_cart_totals_coupon_label( $coupon ) }}</span>
                                </flux:table.cell>
                                <flux:table.cell align="end" class="py-1.5 md:py-2.5 pr-0 align-middle" data-title="{{ esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ) }}">
                                    <span class="text-sm md:text-base font-bold text-primary-600 tracking-tight">{!! wc_cart_totals_coupon_html( $coupon ) !!}</span>
                                </flux:table.cell>
                            </flux:table.row>
                        @endforeach

                        {{-- SHIPPING --}}
                        @if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() )
                            @php
                            do_action( 'woocommerce_cart_totals_before_shipping' );
                            @endphp

                            {!! wc_cart_totals_shipping_html() !!}

                            @php
                            do_action( 'woocommerce_cart_totals_after_shipping' );
                            @endphp
                        @elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) )
                            <flux:table.row class="shipping !border-none">
                                <flux:table.cell class="py-1.5 md:py-2.5 pl-0 align-top">
                                    <span class="text-[10px] md:text-xs font-bold uppercase tracking-[0.2em] text-slate-400">{{ __('Shipping', 'woocommerce') }}</span>
                                </flux:table.cell>
                                <flux:table.cell align="end" class="py-1.5 md:py-2.5 pr-0" data-title="{{ esc_attr__( 'Shipping', 'woocommerce' ) }}">
                                    <div class="text-sm font-medium text-slate-600 italic">
                                        {!! woocommerce_shipping_calculator() !!}
                                    </div>
                                </flux:table.cell>
                            </flux:table.row>
                        @endif

                        {{-- FEES --}}
                        @foreach ( WC()->cart->get_fees() as $fee )
                            <flux:table.row class="fee !border-none">
                                <flux:table.cell class="py-1.5 md:py-2.5 pl-0 align-middle">
                                    <span class="text-[10px] md:text-xs font-bold uppercase tracking-[0.2em] text-slate-400">{{ esc_html( $fee->name ) }}</span>
                                </flux:table.cell>
                                <flux:table.cell align="end" class="py-1.5 md:py-2.5 pr-0 align-middle" data-title="{{ esc_attr( $fee->name ) }}">
                                    <span class="text-sm md:text-base font-bold text-slate-800 tracking-tight">{!! wc_cart_totals_fee_html( $fee ) !!}</span>
                                </flux:table.cell>
                            </flux:table.row>
                        @endforeach

                        {{-- TAXES --}}
                        @php
                        if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
                            $taxable_address = WC()->customer->get_taxable_address();
                            $estimated_text  = '';

                            if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
                                /* translators: %s location. */
                                $estimated_text = sprintf( ' <small class="opacity-50 font-medium">' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
                            }

                            if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
                                foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { ?>
                                    <flux:table.row class="tax-rate tax-rate-{{ esc_attr( sanitize_title( $code ) ) }} !border-none">
                                        <flux:table.cell class="py-1.5 md:py-2.5 pl-0 align-middle">
                                            <span class="text-[10px] md:text-xs font-bold uppercase tracking-[0.2em] text-slate-400">{!! esc_html( $tax->label ) . $estimated_text !!}</span>
                                        </flux:table.cell>
                                        <flux:table.cell align="end" class="py-1.5 md:py-2.5 pr-0 align-middle" data-title="{{ esc_attr( $tax->label ) }}">
                                            <span class="text-sm md:text-base font-bold text-slate-800 tracking-tight">{!! wp_kses_post( $tax->formatted_amount ) !!}</span>
                                        </flux:table.cell>
                                    </flux:table.row>
                                <?php }
                            } else { ?>
                                <flux:table.row class="tax-total !border-none">
                                    <flux:table.cell class="py-1.5 md:py-2.5 pl-0 align-middle">
                                        <span class="text-[10px] md:text-xs font-bold uppercase tracking-[0.2em] text-slate-400">{!! esc_html( WC()->countries->tax_or_vat() ) . $estimated_text !!}</span>
                                    </flux:table.cell>
                                    <flux:table.cell align="end" class="py-1.5 md:py-2.5 pr-0 align-middle" data-title="{{ esc_attr( WC()->countries->tax_or_vat() ) }}">
                                        <span class="text-sm md:text-base font-bold text-slate-800 tracking-tight">{!! wc_cart_totals_taxes_total_html() !!}</span>
                                    </flux:table.cell>
                                </flux:table.row>
                            <?php }
                        }
                        @endphp

                        @php
                        do_action( 'woocommerce_cart_totals_before_order_total' );
                        @endphp

                        {{-- TOTAL --}}
                        <flux:table.row class="order-total !border-t-2 !border-slate-100/50">
                            <flux:table.cell class="py-3 md:py-6 pl-0 align-middle">
                                <span class="text-[9px] md:text-xs font-black uppercase tracking-[0.2em] md:tracking-[0.3em] text-slate-900">{{ __('Total', 'woocommerce') }}</span>
                            </flux:table.cell>
                            <flux:table.cell align="end" class="py-3 md:py-6 pr-0 align-middle" data-title="{{ esc_attr__( 'Total', 'woocommerce' ) }}">
                                <span class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 tracking-tighter drop-shadow-sm select-all break-words">
                                    {!! wc_cart_totals_order_total_html() !!}
                                </span>
                            </flux:table.cell>
                        </flux:table.row>

                        @php
                        do_action( 'woocommerce_cart_totals_after_order_total' );
                        @endphp
                    </flux:table.rows>
                </flux:table>

                <div class="wc-proceed-to-checkout mt-4 md:mt-8">
                    @php
                    do_action( 'woocommerce_proceed_to_checkout' );
                    @endphp
                </div>
            </div>
        </div>

        {{-- Luxury Footer Decoration --}}
        <div class="mt-4 md:mt-6 pt-4 md:pt-6 border-t border-slate-100/50 flex flex-col sm:flex-row items-center justify-between gap-1.5 md:gap-3 opacity-40">
            <flux:icon.lock-closed variant="mini" class="text-primary-600 w-3.5 h-3.5 md:w-5 md:h-5" />
            <span class="text-[8px] md:text-[9px] font-bold uppercase tracking-widest text-slate-400 text-center">{{ __('Secure Checkout', 'detodo24') }}</span>
            <div class="flex gap-1 md:gap-2">
                <div class="w-1 md:w-2 h-1 md:h-2 rounded-full bg-slate-200"></div>
                <div class="w-1 md:w-2 h-1 md:h-2 rounded-full bg-slate-200"></div>
            </div>
        </div>
    </div>

	@php
    do_action( 'woocommerce_after_cart_totals' );
    @endphp

</div>
