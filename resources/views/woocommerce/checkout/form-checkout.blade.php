@php
/**
 * WooCommerce Template Override: checkout/form-checkout.php
 * Premium High-Density Design - Flux UI Integrated
 */
defined('ABSPATH') || exit;
@endphp

<div class="woocommerce-checkout-container max-w-[1400px] mx-auto px-2 sm:px-4 lg:px-8 py-6 md:py-12">
    {{-- Left out global header to avoid duplication --}}

    {{-- Alerts and Notices area --}}
    <div class="checkout-notices mb-8">
        @php do_action( 'woocommerce_before_checkout_form', $checkout ); @endphp
    </div>

    @if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() )
        <flux:card class="!bg-red-50/50 !border-red-100 !p-6 !rounded-2xl shadow-inner mb-10">
            <div class="flex items-center gap-3 text-red-600 font-bold">
                <flux:icon.exclamation-triangle variant="mini" />
                {{ apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) }}
            </div>
        </flux:card>
        @php return; @endphp
    @endif

    <form name="checkout" method="post" class="checkout woocommerce-checkout relative" action="{{ esc_url( wc_get_checkout_url() ) }}" enctype="multipart/form-data">
        <div class="flex flex-col lg:flex-row gap-6 lg:gap-10 items-start">
            
            {{-- Left Column: Customer Details --}}
            <div class="w-full lg:w-[55%] space-y-8">
                @if ( $checkout->get_checkout_fields() )
                    @php do_action( 'woocommerce_checkout_before_customer_details' ); @endphp

                    <flux:card id="customer_details" class="!p-0 overflow-hidden !bg-white/80 backdrop-blur-xl shadow-2xl shadow-slate-200/50 !rounded-[2rem] border-none ring-1 ring-slate-200/50 transition-all hover:shadow-primary-500/5">
                        <div class="p-5 md:p-8 border-b border-slate-100/60 !bg-slate-50/30">
                            <flux:heading size="lg" class="!text-xl md:!text-2xl font-black tracking-tight text-slate-900 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center text-primary-600 group-hover:scale-110 transition-transform">
                                    <flux:icon.user-circle variant="mini" class="w-5 h-5" />
                                </div>
                                {{ __('Billing & Shipping', 'woocommerce') }}
                            </flux:heading>
                        </div>
                        
                        <div class="p-5 md:p-8 space-y-8">
                            <div id="billing_fields_wrapper" class="transition-opacity">
                                @php do_action( 'woocommerce_checkout_billing' ); @endphp
                            </div>

                            <div id="shipping_fields_wrapper" class="pt-10 border-t border-slate-100">
                                @php do_action( 'woocommerce_checkout_shipping' ); @endphp
                            </div>
                        </div>
                    </flux:card>

                    @php do_action( 'woocommerce_checkout_after_customer_details' ); @endphp
                @endif
            </div>

            {{-- Right Column: Order Review --}}
            <div class="w-full lg:w-[45%] lg:sticky lg:top-32">
                @php do_action( 'woocommerce_checkout_before_order_review_heading' ); @endphp
                
                <flux:card class="!p-0 overflow-hidden shadow-2xl shadow-slate-200/50 !bg-white/80 backdrop-blur-xl !rounded-[2rem] border-none ring-1 ring-slate-200/50">
                    <div class="p-5 md:p-8 border-b border-slate-100/60 !bg-slate-50/30">
                        <flux:heading size="lg" class="!text-xl md:!text-2xl font-black tracking-tight text-slate-900 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center text-primary-600">
                                <flux:icon.shopping-bag variant="mini" class="w-5 h-5" />
                            </div>
                            {{ __('Your order', 'woocommerce') }}
                        </flux:heading>
                    </div>

                    <div class="p-5 md:p-8">
                        @php do_action( 'woocommerce_checkout_before_order_review' ); @endphp

                        <div id="order_review" class="woocommerce-checkout-review-order">
                            @php do_action( 'woocommerce_checkout_order_review' ); @endphp
                        </div>

                        @php do_action( 'woocommerce_checkout_after_order_review' ); @endphp
                    </div>
                </flux:card>
            </div>
        </div>
    </form>

    <div class="mt-12 text-center text-slate-400 text-xs font-medium border-t border-slate-100 pt-8 uppercase tracking-widest">
        @php do_action( 'woocommerce_after_checkout_form', $checkout ); @endphp
    </div>
</div>

