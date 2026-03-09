@php
/**
 * WooCommerce Template Override: checkout/payment.php
 * Premium High-Density Payment Section
 * @version 9.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! wp_doing_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
@endphp

<div id="payment" class="woocommerce-checkout-payment !bg-white md:!bg-slate-50/50 !p-0 !rounded-3xl border border-slate-200/60 mt-10 overflow-hidden shadow-inner sm:shadow-none transition-all">
	@if ( WC()->cart && WC()->cart->needs_payment() )
		<ul class="wc_payment_methods payment_methods methods space-y-4 !p-6 md:!p-8 !m-0 list-none">
			@if ( ! empty( $available_gateways ) )
				@foreach ( $available_gateways as $gateway )
					@php wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) ); @endphp
				@endforeach
			@else
				<flux:card class="!bg-amber-50/50 !border-amber-100 !p-4 !shadow-none !rounded-2xl">
					<div class="flex items-center gap-3 text-amber-700 font-medium text-sm">
                        <flux:icon.information-circle variant="mini" class="w-5 h-5" />
						@php wc_print_notice( apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ), 'notice' ); @endphp
					</div>
				</flux:card>
			@endif
		</ul>
	@endif

	<div class="form-row place-order p-5 md:p-8 !bg-transparent !m-0 border-t border-slate-100/60 relative overflow-hidden">
        {{-- Grainy/Glass effect for the footer --}}
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50/50 to-transparent pointer-events-none"></div>

		<noscript>
			<div class="p-4 bg-yellow-50 border border-yellow-200 rounded-xl mb-6 text-xs text-yellow-800">
				@php
				printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
				@endphp
				<br/><button type="submit" class="mt-2 px-4 py-2 bg-yellow-600 text-white rounded-lg font-bold" name="woocommerce_checkout_update_totals" value="{{ esc_attr( __('Update totals', 'woocommerce') ) }}">{{ __('Update totals', 'woocommerce') }}</button>
			</div>
		</noscript>

		@php wc_get_template( 'checkout/terms.php' ); @endphp

		@php do_action( 'woocommerce_review_order_before_submit' ); @endphp

        {{-- Premium Place Order Button --}}
        @php
            $order_button_text = apply_filters( 'woocommerce_order_button_text', __( 'Place order', 'woocommerce' ) );
            $button_html = apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="w-full h-14 !rounded-xl !text-sm font-bold uppercase tracking-[0.2em] shadow-lg shadow-primary-500/30 relative z-10 overflow-hidden border-none !text-white !bg-gradient-to-r from-orange-400 to-orange-600 hover:from-orange-500 hover:to-orange-700 transition-all duration-300 cursor-pointer flex items-center justify-center gap-3" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' );
            echo $button_html;
        @endphp

		@php do_action( 'woocommerce_review_order_after_submit' ); @endphp

		@php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); @endphp
	</div>
</div>

@if ( ! wp_doing_ajax() )
	@php do_action( 'woocommerce_review_order_after_payment' ); @endphp
@endif


