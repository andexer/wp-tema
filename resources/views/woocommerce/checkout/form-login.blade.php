@php
/**
 * Checkout login form
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}
@endphp

<div class="woocommerce-form-login-toggle mb-4">
    <div class="flex items-center gap-3 p-4 !bg-blue-50 border border-blue-100 rounded-xl shadow-sm group">
        <flux:icon.user-circle variant="mini" class="text-blue-500 group-hover:scale-110 transition-transform" />
        <div class="text-sm font-medium text-blue-700">
            {{ __('Returning customer?', 'woocommerce') }} 
            <a href="#" role="button" class="showlogin font-black text-blue-900 hover:text-primary transition-all underline decoration-blue-300 underline-offset-4">
                {{ __('Click here to login', 'woocommerce') }}
            </a>
        </div>
    </div>
</div>

<form class="woocommerce-form woocommerce-form-login login !mt-4 !mb-8 !p-4 md:!p-6 !bg-white border border-slate-200 rounded-2xl shadow-lg !hidden" method="post">
    <flux:subheading class="mb-4 !text-slate-900 !font-black uppercase tracking-wider">{{ __('Login to your account', 'woocommerce') }}</flux:subheading>
    
    <div class="space-y-4">
        <flux:input 
            label="{{ __('Username or email address', 'woocommerce') }}" 
            name="username" 
            id="username" 
            autocomplete="username"
            required
        />

        <flux:input 
            type="password"
            label="{{ __('Password', 'woocommerce') }}" 
            name="password" 
            id="password" 
            autocomplete="current-password"
            required
        />

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <input class="w-4 h-4 rounded border-slate-300 text-primary focus:ring-primary" name="rememberme" type="checkbox" id="rememberme" value="forever" /> 
                <span class="text-xs font-medium text-slate-600">{{ __('Remember me', 'woocommerce') }}</span>
            </div>
            <a href="{{ esc_url( wp_lostpassword_url() ) }}" class="text-xs font-bold text-primary hover:underline">{{ __('Lost your password?', 'woocommerce') }}</a>
        </div>

        <flux:button type="submit" variant="primary" class="w-full font-black uppercase tracking-widest" name="login" value="{{ esc_attr__( 'Login', 'woocommerce' ) }}">
            {{ __('Login', 'woocommerce') }}
        </flux:button>
    </div>

	@php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); @endphp
	<input type="hidden" name="redirect" value="{{ esc_url( wc_get_checkout_url() ) }}" />
</form>
