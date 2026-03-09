@php
/**
 * Checkout billing information form
 */

defined( 'ABSPATH' ) || exit;
@endphp

<div class="woocommerce-billing-fields">
    @php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-5">
        {{-- First Name --}}
        <flux:input 
            :label="__('First name', 'woocommerce')" 
            name="billing_first_name" 
            id="billing_first_name" 
            :value="$checkout->get_value('billing_first_name')" 
            autocomplete="given-name"
            required
        />

        {{-- Last Name --}}
        <flux:input 
            :label="__('Last name', 'woocommerce')" 
            name="billing_last_name" 
            id="billing_last_name" 
            :value="$checkout->get_value('billing_last_name')" 
            autocomplete="family-name"
            required
        />

        {{-- Company (Optional) --}}
        <div class="md:col-span-2">
            <flux:input 
                :label="__('Company name (optional)', 'woocommerce')" 
                name="billing_company" 
                id="billing_company" 
                :value="$checkout->get_value('billing_company')" 
                autocomplete="organization"
            />
        </div>

        {{-- Country / Region --}}
        <div class="md:col-span-2">
            @php
                $countries = WC()->countries->get_allowed_countries();
                $current_country = $checkout->get_value('billing_country');
            @endphp
            <flux:select 
                :label="__('Country / Region', 'woocommerce')" 
                name="billing_country" 
                id="billing_country"
                required
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
                name="billing_address_1" 
                id="billing_address_1" 
                :value="$checkout->get_value('billing_address_1')" 
                :placeholder="esc_attr__( 'House number and street name', 'woocommerce' )"
                autocomplete="address-line1"
                required
            />
            <flux:input 
                name="billing_address_2" 
                id="billing_address_2" 
                :value="$checkout->get_value('billing_address_2')" 
                :placeholder="esc_attr__( 'Apartment, suite, unit, etc. (optional)', 'woocommerce' )"
                autocomplete="address-line2"
            />
        </div>

        {{-- Town / City --}}
        <flux:input 
            :label="__('Town / City', 'woocommerce')" 
            name="billing_city" 
            id="billing_city" 
            :value="$checkout->get_value('billing_city')" 
            autocomplete="address-level2"
            required
        />

        {{-- State / County --}}
        <flux:input 
            :label="__('State / County', 'woocommerce')" 
            name="billing_state" 
            id="billing_state" 
            :value="$checkout->get_value('billing_state')" 
            autocomplete="address-level1"
            required
        />

        {{-- Postcode / ZIP --}}
        <flux:input 
            :label="__('Postcode / ZIP', 'woocommerce')" 
            name="billing_postcode" 
            id="billing_postcode" 
            :value="$checkout->get_value('billing_postcode')" 
            autocomplete="postal-code"
            required
        />

        {{-- Phone --}}
        <flux:input 
            type="tel"
            :label="__('Phone', 'woocommerce')" 
            name="billing_phone" 
            id="billing_phone" 
            :value="$checkout->get_value('billing_phone')" 
            autocomplete="tel"
            required
        />

        {{-- Email Address --}}
        <div class="md:col-span-2">
            <flux:input 
                type="email"
                :label="__('Email address', 'woocommerce')" 
                name="billing_email" 
                id="billing_email" 
                :value="$checkout->get_value('billing_email')" 
                autocomplete="email"
                required
            />
        </div>

        {{-- Fallback for any other fields --}}
        @php
            $all_fields = $checkout->get_checkout_fields( 'billing' );
            $handled_keys = ['billing_first_name', 'billing_last_name', 'billing_company', 'billing_country', 'billing_address_1', 'billing_address_2', 'billing_city', 'billing_state', 'billing_postcode', 'billing_phone', 'billing_email'];
        @endphp

        @foreach ( $all_fields as $key => $field )
            @if(!in_array($key, $handled_keys))
                <div class="checkout-field-wrapper group">
                    @php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); @endphp
                </div>
            @endif
        @endforeach
    </div>

    @php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); @endphp
</div>

@if ( ! is_user_logged_in() && $checkout->is_registration_enabled() )
	<div class="woocommerce-account-fields pt-10 mt-10 border-t border-slate-100">
		@if ( ! $checkout->is_registration_required() )
			<p class="form-row form-row-wide create-account">
				<label class="flex items-center gap-3 cursor-pointer group/acc">
                    <div class="relative flex items-center">
					    <input class="peer w-6 h-6 rounded-lg border-slate-200 text-primary focus:ring-primary/20 transition-all bg-slate-50 appearance-none border checked:bg-primary checked:border-primary shadow-sm" id="createaccount" {{ (true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) )) ? 'checked' : '' }} type="checkbox" name="createaccount" value="1" /> 
                        <flux:icon.check variant="mini" class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity" />
                    </div>
                    <span class="text-base font-black text-slate-900 group-hover/acc:text-primary transition-colors flex items-center gap-2">
                        <flux:icon.user-plus variant="mini" class="text-slate-400 group-hover/acc:text-primary" />
                        {{ __('Create an account?', 'woocommerce') }}
                    </span>
				</label>
			</p>
		@endif

		@php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); @endphp

		@if ( $checkout->get_checkout_fields( 'account' ) )
			<div class="create-account grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-4 mt-8 p-6 bg-slate-50/50 rounded-2xl border border-slate-100">
				@foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field )
					<div class="checkout-field-wrapper group">
                        @php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); @endphp
                    </div>
				@endforeach
				<div class="clear"></div>
			</div>
		@endif

		@php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); @endphp
	</div>
@endif
