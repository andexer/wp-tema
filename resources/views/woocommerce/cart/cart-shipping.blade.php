@php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
@endphp

<flux:table.row class="woocommerce-shipping-totals shipping !border-none">
	<flux:table.cell class="py-2 pl-0 align-top">
        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">{!! wp_kses_post( $package_name ) !!}</span>
    </flux:table.cell>
	<flux:table.cell align="end" class="py-2 pr-0" data-title="{{ esc_attr( $package_name ) }}">
		@if ( ! empty( $available_methods ) && is_array( $available_methods ) )
			<ul id="shipping_method" class="woocommerce-shipping-methods space-y-3">
				@foreach ( $available_methods as $method )
					<li class="flex items-center justify-end gap-3 text-sm font-bold text-slate-700">
						@php
						if ( 1 < count( $available_methods ) ) {
							printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method cursor-pointer accent-primary-600 w-4 h-4" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) );
						} else {
							printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) );
						}
						printf( '<label for="shipping_method_%1$s_%2$s" class="cursor-pointer hover:text-primary-600 transition-colors uppercase tracking-wider text-[11px]">%3$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) );
						do_action( 'woocommerce_after_shipping_rate', $method, $index );
						@endphp
					</li>
				@endforeach
			</ul>
			@if ( is_cart() )
				<div class="woocommerce-shipping-destination mt-4 text-[10px] font-bold uppercase tracking-widest text-slate-400 text-right">
					@php
					if ( $formatted_destination ) {
						// Translators: $s shipping destination.
						printf( esc_html__( 'Delivery to %s.', 'woocommerce' ) . ' ', '<span class="text-slate-600 underline decoration-primary-200">' . esc_html( $formatted_destination ) . '</span>' );
						$calculator_text = esc_html__( 'Update Address', 'woocommerce' );
					} else {
						echo wp_kses_post( apply_filters( 'woocommerce_shipping_estimate_html', __( 'Shipping calculated at checkout.', 'woocommerce' ) ) );
					}
					@endphp
				</div>
			@endif
		@elseif ( ! $has_calculated_shipping || ! $formatted_destination )
			@php
			if ( is_cart() && 'no' === get_option( 'woocommerce_enable_shipping_calc' ) ) {
				echo '<span class="text-xs text-slate-400 italic">' . wp_kses_post( apply_filters( 'woocommerce_shipping_not_enabled_on_cart_html', __( 'Shipping costs are calculated during checkout.', 'woocommerce' ) ) ) . '</span>';
			} else {
				echo '<span class="text-xs text-slate-400 italic">' . wp_kses_post( apply_filters( 'woocommerce_shipping_may_be_available_html', __( 'Enter your address to view shipping options.', 'woocommerce' ) ) ) . '</span>';
			}
			@endphp
		@elseif ( ! is_cart() )
			<span class="text-xs text-red-400">{!! wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'There are no shipping options available.', 'woocommerce' ) ) ) !!}</span>
		@else
			@php
			echo wp_kses_post(
				apply_filters(
					'woocommerce_cart_no_shipping_available_html',
					sprintf( esc_html__( 'No options found for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ),
					$formatted_destination
				)
			);
			$calculator_text = esc_html__( 'Enter address', 'woocommerce' );
			@endphp
		@endif

		@if ( $show_package_details )
			{!! '<p class="woocommerce-shipping-contents text-[10px] text-slate-400 mt-2 text-right"><small>' . esc_html( $package_details ) . '</small></p>' !!}
		@endif

		@if ( $show_shipping_calculator )
            <div class="mt-4 flex justify-end">
			    @php woocommerce_shipping_calculator( $calculator_text ); @endphp
            </div>
		@endif
	</flux:table.cell>
</flux:table.row>
