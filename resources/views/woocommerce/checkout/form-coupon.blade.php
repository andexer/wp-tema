@php
/**
 * WooCommerce Template Override: checkout/form-coupon.php
 * Auto-generated from WooCommerce plugin template.
 * TODO: Personalizar con tu diseño Tailwind/Flux.
 * @version 9.8.0
 */
defined('ABSPATH') || exit;
@endphp

{{-- TODO: Personalizar este template con tu diseño --}}

@php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}
@endphp

<div class="woocommerce-form-coupon-toggle mb-4">
    <div class="flex items-center gap-3 p-4 !bg-slate-50 border border-slate-100 rounded-xl shadow-sm group">
        <flux:icon.tag variant="mini" class="text-primary group-hover:scale-110 transition-transform" />
        <div class="text-sm font-medium text-slate-600">
            {{ __('Have a coupon?', 'woocommerce') }} 
            <a href="#" role="button" class="showcoupon font-black text-slate-900 hover:text-primary transition-all underline decoration-primary/30 underline-offset-4">
                {{ __('Click here to enter your code', 'woocommerce') }}
            </a>
        </div>
    </div>
</div>

<form class="checkout_coupon woocommerce-form-coupon !mt-4 !mb-8 !p-4 md:!p-6 !bg-white border border-slate-200 rounded-2xl shadow-lg !hidden" method="post" id="woocommerce-checkout-form-coupon">
    <flux:subheading class="mb-4 !text-slate-900 !font-black uppercase tracking-wider">{{ __('Enter your coupon code', 'woocommerce') }}</flux:subheading>
    
    <div class="flex flex-col md:flex-row gap-3">
        <div class="flex-1">
            <flux:input name="coupon_code" id="coupon_code" placeholder="{{ esc_attr__( 'Coupon code', 'woocommerce' ) }}" value="" class="!bg-slate-50" />
        </div>
        <flux:button type="submit" variant="primary" class="font-black uppercase tracking-widest" name="apply_coupon" value="{{ esc_attr__( 'Apply coupon', 'woocommerce' ) }}">
            {{ __('Apply', 'woocommerce') }}
        </flux:button>
    </div>
</form>
