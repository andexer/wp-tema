@php
/**
 * WooCommerce Template Override: order/order-details.php
 * Auto-generated from WooCommerce plugin template.
 * TODO: Personalizar con tu diseño Tailwind/Flux.
 * @version 10.1.0
 */
defined('ABSPATH') || exit;
@endphp

{{-- TODO: Personalizar este template con tu diseño --}}

<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 *
 * @var bool $show_downloads Controls whether the downloads table should be rendered.
 */

 // phpcs:disable WooCommerce.Commenting.CommentHooks.MissingHookComment

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items        = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$downloads          = $order->get_downloadable_items();
$actions            = array_filter(
	wc_get_account_orders_actions( $order ),
	function ( $key ) {
		return 'view' !== $key;
	},
	ARRAY_FILTER_USE_KEY
);

// We make sure the order belongs to the user. This will also be true if the user is a guest, and the order belongs to a guest (userID === 0).
$show_customer_details = $order->get_user_id() === get_current_user_id();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>
<section class="woocommerce-order-details mt-10 md:mt-16">
    @php do_action( 'woocommerce_order_details_before_order_table', $order ); @endphp

    <div class="bg-white border border-slate-100 rounded-[2rem] shadow-sm overflow-hidden mb-10">
        <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
            <flux:heading size="lg" class="!text-slate-900 font-black uppercase tracking-tight">
                @php esc_html_e( 'Resumen del Pedido', 'woocommerce' ); @endphp
            </flux:heading>
            <flux:badge variant="subtle" size="sm" class="!rounded-lg !px-3 font-bold">@php echo count($order_items); @endphp Artículos</flux:badge>
        </div>

        <!-- Clean Items List -->
        <div class="divide-y divide-slate-50">
            @php
            do_action( 'woocommerce_order_details_before_order_table_items', $order );

            foreach ( $order_items as $item_id => $item ) {
                $product = $item->get_product();

                wc_get_template(
                    'order/order-details-item.php',
                    array(
                        'order'              => $order,
                        'item_id'            => $item_id,
                        'item'               => $item,
                        'show_purchase_note' => $show_purchase_note,
                        'purchase_note'      => $product ? $product->get_purchase_note() : '',
                        'product'            => $product,
                    )
                );
            }

            do_action( 'woocommerce_order_details_after_order_table_items', $order );
            @endphp
        </div>

        <!-- Consolidated Totals Section -->
        <div class="p-8 md:p-10 bg-slate-50/50 border-t border-slate-100">
            <div class="max-w-sm ml-auto space-y-4">
                @foreach ( $order->get_order_item_totals() as $key => $total )
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{!! wp_strip_all_tags($total['label']) !!}</span>
                        <span class="font-black text-slate-900 tabular-nums {{ strpos($key, 'total') !== false ? 'text-2xl tracking-tighter' : 'text-sm' }}">
                            {!! $total['value'] !!}
                        </span>
                    </div>
                @endforeach

                @if ( $order->get_customer_note() )
                    <div class="mt-8 p-4 bg-white rounded-2xl border border-slate-100 text-sm text-slate-500 italic">
                        <span class="block text-[8px] font-black uppercase tracking-widest text-slate-400 mb-1">Tu nota:</span>
                        {!! wp_kses_post( nl2br( $order->get_customer_note() ) ) !!}
                    </div>
                @endif
            </div>

            @if ( ! empty( $actions ) )
                <div class="mt-8 pt-8 border-t border-slate-100 flex flex-wrap gap-4">
                    @php
                    foreach ( $actions as $key => $action ) {
                        echo sprintf(
                            '<flux:button href="%s" variant="subtle" size="sm" class="!rounded-xl border !border-slate-200" aria-label="%s">%s</flux:button>',
                            esc_url( $action['url'] ),
                            esc_attr( $action['aria-label'] ?? $action['name'] ),
                            esc_html( $action['name'] )
                        );
                    }
                    @endphp
                </div>
            @endif
        </div>
    </div>

    @php do_action( 'woocommerce_order_details_after_order_table', $order ); @endphp
</section>

<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action( 'woocommerce_after_order_details', $order );

if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}
