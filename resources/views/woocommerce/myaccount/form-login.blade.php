@php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
@endphp

@php(do_action('woocommerce_before_customer_login_form'))

<div class="max-w-md mx-auto my-12 relative" id="customer_login" x-data="{ activeTab: 'login' }">

    @if ('yes' === get_option('woocommerce_enable_myaccount_registration'))
        {{-- Tabs Navigation --}}
        <div class="flex p-1 bg-slate-100 rounded-2xl mb-8 relative">
            {{-- Active Background Mover (Animated) --}}
            <div 
                class="absolute inset-y-1 bg-white rounded-xl shadow-sm transition-all duration-300 ease-out z-0"
                :class="activeTab === 'login' ? 'left-1 w-[calc(50%-0.25rem)]' : 'left-[calc(50%+0.125rem)] w-[calc(50%-0.25rem)]'"
            ></div>

            {{-- Login Tab Button --}}
            <button 
                @click.prevent="activeTab = 'login'"
                class="relative z-10 w-1/2 py-3 text-sm font-bold transition-colors duration-300 rounded-xl focus:outline-none"
                :class="activeTab === 'login' ? 'text-primary' : 'text-slate-500 hover:text-slate-700'"
            >
                {{ __('Login', 'woocommerce') }}
            </button>

            {{-- Register Tab Button --}}
            <button 
                @click.prevent="activeTab = 'register'"
                class="relative z-10 w-1/2 py-3 text-sm font-bold transition-colors duration-300 rounded-xl focus:outline-none"
                :class="activeTab === 'register' ? 'text-primary' : 'text-slate-500 hover:text-slate-700'"
            >
                {{ __('Register', 'woocommerce') }}
            </button>
        </div>
    @endif

    {{-- Forms Container (Relative for absolute positioning of outgoing form if needed, but standard flow works fine with Alpine transitions if we wait or just rely on fade) --}}
    <div class="relative bg-white rounded-3xl shadow-xl border border-slate-100 p-8 sm:p-10 overflow-hidden min-h-[400px]">

        {{-- ==================== LOGIN FORM ==================== --}}
        <div 
            x-show="activeTab === 'login'"
            x-transition:enter="transition ease-out duration-500 delay-100"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 absolute inset-0 px-8 sm:px-10 py-8 sm:py-10"
            x-transition:leave-end="opacity-0 -translate-y-4 absolute inset-0 px-8 sm:px-10 py-8 sm:py-10"
            class="w-full"
        >
            <flux:heading size="xl" class="mb-8 text-center">{{ __('Welcome back', 'woocommerce') }}</flux:heading>

            <form class="woocommerce-form woocommerce-form-login login space-y-5" method="post" novalidate>

                @php(do_action('woocommerce_login_form_start'))

                <flux:input 
                    label="{{ __('Username or email address', 'woocommerce') }}" 
                    name="username" 
                    id="username" 
                    autocomplete="username" 
                    value="{{ (! empty($_POST['username']) && is_string($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : '' }}" 
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

                @php(do_action('woocommerce_login_form'))

                <div class="flex items-center justify-between pt-2">
                    <flux:checkbox 
                        label="{{ __('Remember me', 'woocommerce') }}" 
                        name="rememberme" 
                        id="rememberme" 
                        value="forever" 
                    />
                    
                    <p class="woocommerce-LostPassword lost_password text-sm m-0">
                        <flux:link href="{{ esc_url(wp_lostpassword_url()) }}">{{ __('Lost your password?', 'woocommerce') }}</flux:link>
                    </p>
                </div>

                <div class="pt-4">
                    @php(wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'))
                    <flux:button type="submit" variant="primary" class="w-full py-3" name="login" value="{{ esc_attr__('Log in', 'woocommerce') }}">
                        {{ __('Log in', 'woocommerce') }}
                    </flux:button>
                </div>

                @php(do_action('woocommerce_login_form_end'))

            </form>
        </div>


        {{-- ==================== REGISTER FORM ==================== --}}
        @if ('yes' === get_option('woocommerce_enable_myaccount_registration'))
        <div 
            x-show="activeTab === 'register'"
            x-transition:enter="transition ease-out duration-500 delay-100"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 absolute inset-0 px-8 sm:px-10 py-8 sm:py-10"
            x-transition:leave-end="opacity-0 -translate-y-4 absolute inset-0 px-8 sm:px-10 py-8 sm:py-10"
            style="display: none;"
            class="w-full"
        >
            <flux:heading size="xl" class="mb-8 text-center">{{ __('Create an account', 'woocommerce') }}</flux:heading>

            <form method="post" class="woocommerce-form woocommerce-form-register register space-y-5" @php(do_action('woocommerce_register_form_tag'))>

                @php(do_action('woocommerce_register_form_start'))

                @if ('no' === get_option('woocommerce_registration_generate_username'))

                    <flux:input 
                        label="{{ __('Username', 'woocommerce') }}" 
                        name="username" 
                        id="reg_username" 
                        autocomplete="username" 
                        value="{{ (! empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : '' }}" 
                        required 
                    />

                @endif

                <flux:input 
                    type="email" 
                    label="{{ __('Email address', 'woocommerce') }}" 
                    name="email" 
                    id="reg_email" 
                    autocomplete="email" 
                    value="{{ (! empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : '' }}" 
                    required 
                />

                @if ('no' === get_option('woocommerce_registration_generate_password'))

                    <flux:input 
                        type="password" 
                        label="{{ __('Password', 'woocommerce') }}" 
                        name="password" 
                        id="reg_password" 
                        autocomplete="new-password" 
                        required 
                    />

                @else

                    <p class="text-sm text-gray-600 bg-blue-50 p-4 rounded-xl border border-blue-100">{{ __('A link to set a new password will be sent to your email address.', 'woocommerce') }}</p>

                @endif

                @php(do_action('woocommerce_register_form'))

                <div class="pt-6">
                    @php(wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'))
                    <flux:button type="submit" variant="primary" class="w-full py-3" name="register" value="{{ esc_attr__('Register', 'woocommerce') }}">
                        {{ __('Register', 'woocommerce') }}
                    </flux:button>
                </div>

                @php(do_action('woocommerce_register_form_end'))

            </form>
        </div>
        @endif

    </div>
</div>

@php(do_action('woocommerce_after_customer_login_form'))
