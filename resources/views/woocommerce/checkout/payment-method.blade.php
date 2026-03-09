@php
/**
 * WooCommerce Template Override: checkout/payment-method.php
 * Auto-generated from WooCommerce plugin template.
 * TODO: Personalizar con tu diseño Tailwind/Flux.
 * @version     3.5.0
 */
defined('ABSPATH') || exit;
@endphp

{{-- TODO: Personalizar este template con tu diseño --}}

@php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
@endphp

<li class="wc_payment_method payment_method_{{ esc_attr( $gateway->id ) }} group">
	<input id="payment_method_{{ esc_attr( $gateway->id ) }}" type="radio" class="input-radio peer" name="payment_method" value="{{ esc_attr( $gateway->id ) }}" @php checked( $gateway->chosen, true ); @endphp data-order_button_text="{{ esc_attr( $gateway->order_button_text ) }}" />

	<label for="payment_method_{{ esc_attr( $gateway->id ) }}" class="cursor-pointer">
		<div class="flex-1 flex items-center justify-between gap-4">
            <span class="font-bold text-slate-900 leading-tight">
                {!! $gateway->get_title() !!}
            </span>
            <div class="payment-icon opacity-60 group-hover:opacity-100 transition-opacity scale-90 md:scale-100">
                {!! $gateway->get_icon() !!}
            </div>
        </div>
	</label>

	@if ( $gateway->has_fields() || $gateway->get_description() )
		<div class="payment_box payment_method_{{ esc_attr( $gateway->id ) }}" @if ( ! $gateway->chosen ) style="display:none;" @endif>
			@php $gateway->payment_fields(); @endphp
		</div>
	@endif
</li>

