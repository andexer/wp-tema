@php
/**
 * Checkout shipping information form
 */

defined( 'ABSPATH' ) || exit;
@endphp

<div class="woocommerce-shipping-fields">
	@if ( true === WC()->cart->needs_shipping_address() )
		<div class="shipping_address space-y-5">
			@php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); @endphp

			<div class="grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-5">
				{{-- First Name --}}
                <flux:input 
                    :label="__('First name', 'woocommerce')" 
                    name="shipping_first_name" 
                    id="shipping_first_name" 
                    :value="$checkout->get_value('shipping_first_name')" 
                    autocomplete="given-name"
                />

                {{-- Last Name --}}
                <flux:input 
                    :label="__('Last name', 'woocommerce')" 
                    name="shipping_last_name" 
                    id="shipping_last_name" 
                    :value="$checkout->get_value('shipping_last_name')" 
                    autocomplete="family-name"
                />

                {{-- Company --}}
                <div class="md:col-span-2">
                    <flux:input 
                        :label="__('Company name (optional)', 'woocommerce')" 
                        name="shipping_company" 
                        id="shipping_company" 
                        :value="$checkout->get_value('shipping_company')" 
                        autocomplete="organization"
                    />
                </div>

                {{-- Country / Region --}}
                <div class="md:col-span-2">
                    @php
                        $countries = WC()->countries->get_allowed_countries();
                        $current_country = $checkout->get_value('shipping_country');
                    @endphp
                    <flux:select 
                        :label="__('Country / Region', 'woocommerce')" 
                        name="shipping_country" 
                        id="shipping_country"
                    >
                        @foreach($countries as $code => $name)
                            <option value="{{ $code }}" {{ $current_country === $code ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </flux:select>
                </div>

                {{-- Street Address --}}
                <div class="md:col-span-2 space-y-3">
                    <flux:input 
                        :label="__('Street address', 'woocommerce')" 
                        name="shipping_address_1" 
                        id="shipping_address_1" 
                        :value="$checkout->get_value('shipping_address_1')" 
                        :placeholder="esc_attr__( 'House number and street name', 'woocommerce' )"
                        autocomplete="address-line1"
                    />
                    <flux:input 
                        name="shipping_address_2" 
                        id="shipping_address_2" 
                        :value="$checkout->get_value('shipping_address_2')" 
                        :placeholder="esc_attr__( 'Apartment, suite, unit, etc. (optional)', 'woocommerce' )"
                        autocomplete="address-line2"
                    />
                </div>

                {{-- Town / City --}}
                <flux:input 
                    :label="__('Town / City', 'woocommerce')" 
                    name="shipping_city" 
                    id="shipping_city" 
                    :value="$checkout->get_value('shipping_city')" 
                    autocomplete="address-level2"
                />

                {{-- State / County --}}
                <flux:input 
                    :label="__('State / County', 'woocommerce')" 
                    name="shipping_state" 
                    id="shipping_state" 
                    :value="$checkout->get_value('shipping_state')" 
                    autocomplete="address-level1"
                />

                {{-- Postcode / ZIP --}}
                <flux:input 
                    :label="__('Postcode / ZIP', 'woocommerce')" 
                    name="shipping_postcode" 
                    id="shipping_postcode" 
                    :value="$checkout->get_value('shipping_postcode')" 
                    autocomplete="postal-code"
                />
			</div>

			@php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); @endphp
		</div>
	@endif
</div>

<div class="woocommerce-additional-fields pt-10 mt-10 border-t border-slate-100">
	@php do_action( 'woocommerce_before_order_notes', $checkout ); @endphp

	@if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) )
		<div class="woocommerce-additional-fields__field-wrapper">
			@foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field )
				<flux:textarea 
                    :label="esc_html( $field['label'] )" 
                    :name="esc_attr( $key )" 
                    :id="esc_attr( $key )" 
                    :placeholder="esc_attr( $field['placeholder'] ?? '' )" 
                    rows="3"
                >{{ $checkout->get_value( $key ) }}</flux:textarea>
			@endforeach
		</div>
	@endif

	@php do_action( 'woocommerce_after_order_notes', $checkout ); @endphp
</div>
