@php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
do_action( 'woocommerce_before_shipping_calculator' );
@endphp

<form class="woocommerce-shipping-calculator space-y-4" action="{{ esc_url( wc_get_cart_url() ) }}" method="post">

	@php
    printf( '<a href="#" class="shipping-calculator-button text-[9px] font-black uppercase tracking-[0.2em] text-primary-600 hover:text-slate-900 flex items-center gap-1.5 transition-all duration-300" aria-expanded="false" aria-controls="shipping-calculator-form" role="button">%s <flux:icon.plus-circle variant="micro" class="w-3.5 h-3.5" /></a>', esc_html( ! empty( $button_text ) ? $button_text : __( 'Calculate shipping', 'woocommerce' ) ) );
    @endphp

	<section class="shipping-calculator-form space-y-3 pt-3 mt-2 border-t border-slate-100" id="shipping-calculator-form" style="display:none;">

		@if ( apply_filters( 'woocommerce_shipping_calculator_enable_country', true ) )
			<div class="form-row form-row-wide" id="calc_shipping_country_field">
				<label for="calc_shipping_country" class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">{{ __('Country / region', 'woocommerce') }}</label>
				<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state country_select w-full rounded-xl border-slate-200 bg-slate-50/50 px-3 py-2 text-xs font-bold text-slate-700 focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all appearance-none cursor-pointer" rel="calc_shipping_state">
					<option value="default">{{ __('Select a country / region&hellip;', 'woocommerce') }}</option>
					@foreach ( WC()->countries->get_shipping_countries() as $key => $value )
						<option value="{{ esc_attr( $key ) }}" {{ selected( WC()->customer->get_shipping_country(), $key, false ) }}>{{ esc_html( $value ) }}</option>
					@endforeach
				</select>
			</div>
		@endif

		@if ( apply_filters( 'woocommerce_shipping_calculator_enable_state', true ) )
			<div class="form-row form-row-wide" id="calc_shipping_state_field">
				@php
				$current_cc = WC()->customer->get_shipping_country();
				$current_r  = WC()->customer->get_shipping_state();
				$states     = WC()->countries->get_states( $current_cc );

				if ( is_array( $states ) && empty( $states ) ) {
					echo '<input type="hidden" name="calc_shipping_state" id="calc_shipping_state" />';
				} elseif ( is_array( $states ) ) {
					@endphp
					<span>
						<label for="calc_shipping_state" class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">{{ __('State / County', 'woocommerce') }}</label>
						<select name="calc_shipping_state" class="state_select w-full rounded-xl border-slate-200 bg-slate-50/50 px-3 py-2 text-xs font-bold text-slate-700 focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all appearance-none cursor-pointer" id="calc_shipping_state">
							<option value="">{{ __('Select an option&hellip;', 'woocommerce') }}</option>
							@foreach ( $states as $ckey => $cvalue )
								<option value="{{ esc_attr( $ckey ) }}" {{ selected( $current_r, $ckey, false ) }}>{{ esc_html( $cvalue ) }}</option>
							@endforeach
						</select>
					</span>
					@php
				} else {
					@endphp
					<flux:input label="{{ __('State / County', 'woocommerce') }}" name="calc_shipping_state" id="calc_shipping_state" value="{{ esc_attr( $current_r ) }}" variant="outline" class="!rounded-2xl" />
					@php
				}
				@endphp
			</div>
		@endif

		@if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', true ) )
			<flux:input label="{{ __('City:', 'woocommerce') }}" name="calc_shipping_city" id="calc_shipping_city" value="{{ esc_attr( WC()->customer->get_shipping_city() ) }}" variant="outline" class="!rounded-xl" size="sm" />
		@endif

		@if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) )
			<flux:input label="{{ __('Postcode / ZIP:', 'woocommerce') }}" name="calc_shipping_postcode" id="calc_shipping_postcode" value="{{ esc_attr( WC()->customer->get_shipping_postcode() ) }}" variant="outline" class="!rounded-xl" size="sm" />
		@endif

		<div class="pt-2 pb-1">
            <flux:button type="submit" name="calc_shipping" value="1" variant="primary" class="w-full !rounded-xl h-10 font-bold uppercase tracking-wider text-[10px] shadow-md transition-all">
                {{ __('Update Details', 'woocommerce') }}
            </flux:button>
        </div>
		@php wp_nonce_field( 'woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce' ); @endphp
	</section>
</form>

@php do_action( 'woocommerce_after_shipping_calculator' ); @endphp
