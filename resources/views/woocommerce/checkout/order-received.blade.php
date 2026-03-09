@php
/**
 * WooCommerce Template Override: checkout/order-received.php
 * @version 8.8.0
 */
defined('ABSPATH') || exit;
@endphp

@php
/**
 * "Order received" message — hidden because thankyou.blade.php
 * already displays a styled "¡Pedido Confirmado!" header.
 * We keep the filter so plugins can still hook into it.
 */
$message = apply_filters(
    'woocommerce_thankyou_order_received_text',
    esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ),
    $order
);
@endphp
{{-- Message intentionally hidden — displayed in thankyou.blade.php header --}}
