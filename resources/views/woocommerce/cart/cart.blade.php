@php
defined( 'ABSPATH' ) || exit;
@endphp

@php(do_action('woocommerce_before_cart'))

{{-- Spacer para separar del hero/header si es necesario --}}
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
            <form class="woocommerce-cart-form bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden" action="{{ esc_url( wc_get_cart_url() ) }}" method="post">
                @php(do_action('woocommerce_before_cart_table'))

                <div class="overflow-x-auto">
                    <table class="w-full shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="py-4 px-6 text-left text-sm font-bold text-slate-700 uppercase tracking-wider product-thumbnail" colspan="2">{{ __('Product', 'woocommerce') }}</th>
                                <th class="py-4 px-6 text-left text-sm font-bold text-slate-700 uppercase tracking-wider product-price">{{ __('Price', 'woocommerce') }}</th>
                                <th class="py-4 px-6 text-center text-sm font-bold text-slate-700 uppercase tracking-wider product-quantity">{{ __('Quantity', 'woocommerce') }}</th>
                                <th class="py-4 px-6 text-right text-sm font-bold text-slate-700 uppercase tracking-wider product-subtotal">{{ __('Subtotal', 'woocommerce') }}</th>
                                <th class="py-4 px-6 product-remove">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @php(do_action('woocommerce_before_cart_contents'))

                            @foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item )
                                @php
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                                @endphp

                                @if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) )
                                    @php
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                    @endphp

                                    <tr class="woocommerce-cart-form__cart-item {{ esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item group transition-colors hover:bg-slate-50/50', $cart_item, $cart_item_key ) ) }}">

                                        {{-- THUMBNAIL --}}
                                        <td class="py-6 pl-6 pr-4 w-24 product-thumbnail">
                                            @php
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_gallery_thumbnail', ['class' => 'w-20 h-20 object-cover rounded-xl shadow-sm']), $cart_item, $cart_item_key );
                                            @endphp

                                            @if ( ! $product_permalink )
                                                {!! $thumbnail !!}
                                            @else
                                                <a href="{{ esc_url( $product_permalink ) }}" class="block transition-transform hover:scale-105 duration-300">
                                                    {!! $thumbnail !!}
                                                </a>
                                            @endif
                                        </td>

                                        {{-- NOMBRE --}}
                                        <td class="py-6 px-4 product-name" data-title="{{ esc_attr__( 'Product', 'woocommerce' ) }}">
                                            @if ( ! $product_permalink )
                                                <span class="font-bold text-secondary text-lg">{!! wp_kses_post( $product_name . '&nbsp;' ) !!}</span>
                                            @else
                                                <a href="{{ esc_url( $product_permalink ) }}" class="font-bold text-secondary text-lg hover:text-primary transition-colors">
                                                    {!! wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) !!}
                                                </a>
                                            @endif

                                            @php(do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key))

                                            <div class="mt-1 text-sm text-slate-500">
                                                {!! wc_get_formatted_cart_item_data( $cart_item ) !!}
                                            </div>

                                            @if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
                                                <p class="mt-2 text-xs font-semibold text-amber-600 bg-amber-50 inline-block px-2 py-1 rounded">
                                                    {!! wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', esc_html__( 'Available on backorder', 'woocommerce' ), $product_id ) ) !!}
                                                </p>
                                            @endif

                                            {{-- Vista móvil del precio --}}
                                            <div class="md:hidden mt-2 font-semibold text-primary">
                                                {!! apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ) !!}
                                            </div>
                                        </td>

                                        {{-- PRECIO --}}
                                        <td class="hidden md:table-cell py-6 px-4 product-price font-semibold text-slate-600" data-title="{{ esc_attr__( 'Price', 'woocommerce' ) }}">
                                            {!! apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ) !!}
                                        </td>

                                        {{-- CANTIDAD --}}
                                        <td class="py-6 px-4 product-quantity" data-title="{{ esc_attr__( 'Quantity', 'woocommerce' ) }}">
                                            <div class="flex justify-center md:justify-start">
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
                                                        'classes'      => ['w-20', 'text-center', 'font-bold', 'rounded-xl', 'border-slate-200', 'bg-slate-50', 'py-2', 'focus:ring-primary/20']
                                                    ),
                                                    $_product,
                                                    false
                                                );
                                                @endphp

                                                {!! apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ) !!}
                                            </div>
                                        </td>

                                        {{-- SUBTOTAL --}}
                                        <td class="py-6 px-4 text-right product-subtotal font-black text-primary text-lg" data-title="{{ esc_attr__( 'Subtotal', 'woocommerce' ) }}">
                                            {!! apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) !!}
                                        </td>

                                        {{-- ELIMINAR --}}
                                        <td class="py-6 pr-6 pl-2 text-right product-remove">
                                            @php
                                            echo apply_filters(
                                                'woocommerce_cart_item_remove_link',
                                                sprintf(
                                                    '<a href="%s" class="remove inlne-flex items-center justify-center w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all text-xl font-bold leading-none cursor-pointer" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                    esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                                    esc_attr( $product_id ),
                                                    esc_attr( $_product->get_sku() )
                                                ),
                                                $cart_item_key
                                            );
                                            @endphp
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                            @php(do_action('woocommerce_cart_contents'))

                            {{-- ACCIONES INFERIORES --}}
                            <tr class="bg-slate-50/50">
                                <td colspan="6" class="p-6 actions">
                                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                                        
                                        @if ( wc_coupons_enabled() )
                                            <div class="coupon flex w-full sm:w-auto gap-3">
                                                <flux:input 
                                                    name="coupon_code" 
                                                    id="coupon_code" 
                                                    value="" 
                                                    placeholder="{{ esc_attr__( 'Coupon code', 'woocommerce' ) }}"
                                                    class="min-w-[200px]"
                                                />
                                                <flux:button type="submit" variant="default" name="apply_coupon" value="{{ esc_attr__('Apply coupon', 'woocommerce') }}">
                                                    {{ __('Apply coupon', 'woocommerce') }}
                                                </flux:button>
                                                
                                                @php(do_action('woocommerce_cart_coupon'))
                                            </div>
                                        @endif

                                        <flux:button type="submit" variant="subtle" class="w-full sm:w-auto" name="update_cart" value="{{ esc_attr__('Update cart', 'woocommerce') }}">
                                            {{ __('Update cart', 'woocommerce') }}
                                        </flux:button>

                                        @php(do_action('woocommerce_cart_actions'))
                                        @php(wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'))
                                    </div>
                                </td>
                            </tr>

                            @php(do_action('woocommerce_after_cart_contents'))
                        </tbody>
                    </table>
                </div>
                @php(do_action('woocommerce_after_cart_table'))
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
                @php(do_action('woocommerce_before_cart_collaterals'))
                
                {{-- Envolvemos los totales en nuestra propia tarjeta redondeada --}}
                <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
                    @php(do_action('woocommerce_cart_collaterals'))
                </div>
            </div>
        </div>

    </div>
</div>

@php(do_action('woocommerce_after_cart'))
