@php(defined( 'ABSPATH' ) || exit)

@php(do_action('woocommerce_before_cart'))

{{-- Spacer --}}
<div class="my-8 md:my-16"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" 
     x-data="{ show: false }" 
     x-init="setTimeout(() => show = true, 50)">

    <flux:heading size="xl" class="mb-8 text-center" 
        x-show="show" 
        x-transition:enter="transition ease-out duration-500 delay-100"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
    >
        {{ __('Shopping Cart', 'woocommerce') }}
    </flux:heading>

    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12"
         x-show="show"
         x-transition:enter="transition ease-out duration-700 delay-200"
         x-transition:enter-start="opacity-0 translate-y-8"
         x-transition:enter-end="opacity-100 translate-y-0"
    >
        
        {{-- ==================== COLUMNA IZQUIERDA: CARRO ==================== --}}
        <div class="w-full lg:w-2/3">
            <form class="woocommerce-cart-form" action="{{ esc_url( wc_get_cart_url() ) }}" method="post">
                @php(do_action('woocommerce_before_cart_table'))

                <flux:card class="p-0 overflow-hidden">
                    <flux:table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                        <thead>
                            <tr class="text-sm font-semibold text-slate-500 border-b border-slate-200">
                                <th class="pb-3 text-left w-2/5">{{ __('Product', 'woocommerce') }}</th>
                                <th class="pb-3 text-left">{{ __('Price', 'woocommerce') }}</th>
                                <th class="pb-3 text-center">{{ __('Quantity', 'woocommerce') }}</th>
                                <th class="pb-3 text-right">{{ __('Subtotal', 'woocommerce') }}</th>
                                <th class="pb-3 w-10"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @php(do_action('woocommerce_before_cart_contents'))

                            <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) : ?>
                                @php
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                                @endphp

                                <?php if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) : ?>
                                    @php
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                    @endphp

                                    <tr class="woocommerce-cart-form__cart-item {{ esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item group transition-colors hover:bg-slate-50/50', $cart_item, $cart_item_key ) ) }}">

                                        {{-- THUMBNAIL & NOMBRE --}}
                                        <td class="py-6 flex flex-col md:flex-row md:items-center gap-4 product-name" data-title="{{ esc_attr__( 'Product', 'woocommerce' ) }}">
                                            @php
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_gallery_thumbnail', ['class' => 'w-16 h-16 md:w-20 md:h-20 object-cover rounded-xl shadow-sm']), $cart_item, $cart_item_key );
                                            @endphp
                                            
                                            <div class="product-thumbnail shrink-0">
                                                @if ( ! $product_permalink )
                                                    {!! $thumbnail !!}
                                                @else
                                                    <a href="{{ esc_url( $product_permalink ) }}" class="block transition-transform hover:scale-105 duration-300">
                                                        {!! $thumbnail !!}
                                                    </a>
                                                @endif
                                            </div>

                                            <div>
                                                @if ( ! $product_permalink )
                                                    <span class="font-bold text-slate-800 text-base md:text-lg">{!! wp_kses_post( $product_name . '&nbsp;' ) !!}</span>
                                                @else
                                                    <a href="{{ esc_url( $product_permalink ) }}" class="font-bold text-slate-800 text-base md:text-lg hover:text-indigo-600 transition-colors">
                                                        {!! wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) !!}
                                                    </a>
                                                @endif

                                                @php
                                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);
                                                @endphp

                                                <div class="mt-1 text-xs md:text-sm text-slate-500">
                                                    {!! wc_get_formatted_cart_item_data( $cart_item ) !!}
                                                </div>

                                                <?php if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) : ?>
                                                    <span class="mt-2 text-xs text-amber-600 bg-amber-50 px-2 py-1 rounded-md font-medium border border-amber-200">
                                                        {!! wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', esc_html__( 'Available on backorder', 'woocommerce' ), $product_id ) ) !!}
                                                    </span>
                                                <?php endif; ?>

                                                {{-- Mobile price view --}}
                                                <div class="md:hidden mt-2 font-semibold text-indigo-600">
                                                    {!! apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ) !!}
                                                </div>
                                            </div>
                                        </td>

                                        {{-- PRECIO --}}
                                        <td class="hidden md:table-cell py-6 product-price font-medium text-slate-600 align-middle" data-title="{{ esc_attr__( 'Price', 'woocommerce' ) }}">
                                            {!! apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ) !!}
                                        </td>

                                        {{-- CANTIDAD --}}
                                        <td class="py-6 product-quantity text-center align-middle" data-title="{{ esc_attr__( 'Quantity', 'woocommerce' ) }}">
                                            <div class="flex justify-center">
                                                @php
                                                if ( $_product->is_sold_individually() ) {
                                                    $min_quantity = 1;
                                                    $max_quantity = 1;
                                                } else {
                                                    $min_quantity = 0;
                                                    $max_quantity = $_product->get_max_purchase_quantity();
                                                }

                                                $product_quantity = woocommerce_quantity_input(
                                                    array(
                                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                                        'input_value'  => $cart_item['quantity'],
                                                        'max_value'    => $max_quantity,
                                                        'min_value'    => $min_quantity,
                                                        'product_name' => $product_name,
                                                        'classes'      => ['w-16', 'md:w-20', 'text-center', 'font-medium', 'rounded-lg', 'border-slate-300', 'bg-white', 'py-1.5', 'text-sm', 'focus:ring-indigo-500', 'focus:border-indigo-500']
                                                    ),
                                                    $_product,
                                                    false
                                                );
                                                @endphp

                                                {!! apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ) !!}
                                            </div>
                                        </td>

                                        {{-- SUBTOTAL --}}
                                        <td class="py-6 text-right product-subtotal font-bold text-indigo-600 text-base md:text-lg align-middle" data-title="{{ esc_attr__( 'Subtotal', 'woocommerce' ) }}">
                                            {!! apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) !!}
                                        </td>

                                        {{-- ELIMINAR --}}
                                        <td class="py-6 text-right product-remove align-middle">
                                            @php
                                            $remove_url = esc_url( wc_get_cart_remove_url( $cart_item_key ) );
                                            $remove_label = esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) );
                                            @endphp
                                            
                                            <a href="{{ $remove_url }}" class="remove text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-full inline-flex items-center justify-center transition-colors" aria-label="{{ $remove_label }}" data-product_id="{{ esc_attr( $product_id ) }}" data-product_sku="{{ esc_attr( $_product->get_sku() ) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            @php
                                do_action('woocommerce_cart_contents');
                            @endphp

                            {{-- ACCIONES INFERIORES --}}
                            <tr class="bg-slate-50/50">
                                <td colspan="5" class="py-4 actions">
                                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                                        
                                        @if ( wc_coupons_enabled() )
                                            <div class="coupon flex w-full sm:w-auto gap-3">
                                                <flux:input 
                                                    name="coupon_code" 
                                                    id="coupon_code" 
                                                    value="" 
                                                    placeholder="{{ esc_attr__( 'Coupon code', 'woocommerce' ) }}"
                                                    class="min-w-[150px] md:min-w-[200px]"
                                                />
                                                <flux:button type="submit" variant="primary" name="apply_coupon" value="{{ esc_attr__('Apply coupon', 'woocommerce') }}">
                                                    {{ __('Apply coupon', 'woocommerce') }}
                                                </flux:button>
                                                
                                                @php
                                                    do_action('woocommerce_cart_coupon');
                                                @endphp
                                            </div>
                                        @endif

                                        <flux:button type="submit" variant="outline" class="w-full sm:w-auto" name="update_cart" value="{{ esc_attr__('Update cart', 'woocommerce') }}">
                                            {{ __('Update cart', 'woocommerce') }}
                                        </flux:button>

                                        @php
                                            do_action('woocommerce_cart_actions');
                                            wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce');
                                        @endphp
                                    </div>
                                </td>
                            </tr>

                            @php
                                do_action('woocommerce_after_cart_contents');
                            @endphp
                        </tbody>
                    </table>
                </div>
                @php
                    do_action('woocommerce_after_cart_table');
                @endphp
            </form>
        </div>


        {{-- ==================== COLUMNA DERECHA: TOTALES ==================== --}}
        <div class="w-full lg:w-1/3">
            <div class="cart-collaterals sticky top-24"
                 x-show="show"
                 x-transition:enter="transition ease-out duration-700 delay-300"
                 x-transition:enter-start="opacity-0 translate-x-8"
                 x-transition:enter-end="opacity-100 translate-x-0"
            >
                @php
                    do_action('woocommerce_before_cart_collaterals');
                @endphp
                
                <flux:card class="border-t-4 border-t-indigo-600 p-6 md:p-8 shadow-xl relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/50 to-transparent pointer-events-none"></div>
                    <div class="relative z-10">
                        @php
                            do_action('woocommerce_cart_collaterals');
                        @endphp
                    </div>
                </flux:card>
            </div>
        </div>

    </div>
</div>

@php
    do_action('woocommerce_after_cart');
@endphp
