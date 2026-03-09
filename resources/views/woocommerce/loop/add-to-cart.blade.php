@php
/**
 * WooCommerce Template Override: loop/add-to-cart.php
 * Custom Flux UI integration for the loop add to cart button.
 */
defined('ABSPATH') || exit;

global $product;

$classes = isset( $args['class'] ) ? $args['class'] : 'button';
// We must ensure the Woocommerce AJAX classes are present for the JS to bind
if (strpos($classes, 'add_to_cart_button') === false) {
    $classes .= ' add_to_cart_button ajax_add_to_cart';
}
@endphp

<div class="w-full flex">
    <flux:button 
        href="{{ esc_url( $product->add_to_cart_url() ) }}" 
        variant="primary" 
        class="w-full !rounded-xl !font-black !uppercase !tracking-wider !text-xs !shadow-sm hover:!shadow-md transition-all active:scale-95 flex items-center justify-center gap-2 {{ $classes }}"
        data-quantity="{{ esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ) }}"
        data-product_id="{{ esc_attr( $product->get_id() ) }}"
        data-product_sku="{{ esc_attr( $product->get_sku() ) }}"
        aria-label="{{ esc_attr( $product->add_to_cart_description() ) }}"
        aria-describedby="{{ isset($args['aria-describedby_text']) ? 'woocommerce_loop_add_to_cart_link_describedby_' . $product->get_id() : '' }}"
    >
        <flux:icon.shopping-bag variant="solid" class="w-4 h-4" />
        {{ esc_html( $product->add_to_cart_text() ) }}
    </flux:button>
</div>

@if ( isset( $args['aria-describedby_text'] ) )
	<span id="woocommerce_loop_add_to_cart_link_describedby_{{ esc_attr( $product->get_id() ) }}" class="screen-reader-text">
		{{ esc_html( $args['aria-describedby_text'] ) }}
	</span>
@endif
