@php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
@endphp

<div class="relative group/checkout">
    {{-- Button Glow Effect --}}
    <div class="absolute inset-0 bg-primary-600 rounded-xl blur-lg opacity-10 group-hover/checkout:opacity-30 transition-opacity duration-500"></div>

    <flux:button 
        as="link" 
        href="{{ esc_url( wc_get_checkout_url() ) }}" 
        wire:navigate
        variant="primary" 
        size="base" 
        class="w-full h-12 !rounded-xl !text-sm font-bold uppercase tracking-[0.15em] shadow-lg relative z-10 overflow-hidden group/btn border-none !text-white"
    >
        {{-- Luxury Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-r from-orange-400 to-orange-600 opacity-90 group-hover/btn:opacity-100 transition-opacity duration-500"></div>
        
        <div class="relative z-20 flex items-center justify-center gap-3">
            {{ __('Proceed to checkout', 'woocommerce') }}
            <flux:icon.arrow-right-circle variant="mini" class="w-5 h-5 transition-transform duration-500 group-hover/btn:translate-x-1.5" />
        </div>
    </flux:button>
</div>
