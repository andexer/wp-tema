<?php

use Livewire\Component;

new class extends Component
{
    public string $title = 'Productos Recomendados';
    public string $viewAllUrl = '#';
    public array $products = [];
    public int $perPage = 10;

    public function mount(string $title = 'Productos Recomendados', string $viewAllUrl = '#', string $source = 'featured'): void
    {
        $this->title = $title;
        $this->viewAllUrl = $viewAllUrl;

        if (function_exists('wc_get_products')) {
            $args = [
                'limit'  => $this->perPage,
                'status' => 'publish',
                'orderby' => 'date',
                'order'  => 'DESC',
            ];

            if ($source === 'featured') {
                $args['featured'] = true;
            } elseif ($source === 'sale') {
                $args['on_sale'] = true;
            }

            $wcProducts = wc_get_products($args);

            $this->products = collect($wcProducts)->map(function ($product) {
                $badge = '';
                $badgeColor = 'red';

                if ($product->is_on_sale()) {
                    $regular = (float) $product->get_regular_price();
                    $sale = (float) $product->get_sale_price();
                    if ($regular > 0) {
                        $discount = round((($regular - $sale) / $regular) * 100);
                        $badge = $discount . '% OFF';
                        $badgeColor = 'orange';
                    } else {
                        $badge = 'OFERTA';
                    }
                }

                return [
                    'id'         => $product->get_id(),
                    'name'       => $product->get_name(),
                    'price'      => $product->get_price_html(),
                    'image'      => wp_get_attachment_url($product->get_image_id()) ?: wc_placeholder_img_src(),
                    'url'        => $product->get_permalink(),
                    'badge'      => $badge,
                    'badgeColor' => $badgeColor,
                ];
            })->toArray();
        }

        // Fallback si no hay productos
        if (empty($this->products)) {
            $this->products = [
                ['id' => 0, 'name' => 'Wireless Noise Canceling Headphones', 'price' => '$129.99', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDyZR5vPDnOUeazrq8TYY4QgwKh32Wl6elyLu5g9Eyg0tr-V0uL8t4OkhtP6QtalpobBJDka8coha6LKE6LSFKdjvCf9EPwLj3dcmbC_1c2clEuAdlvORn_QV3jVNjo6FFsxegT4FnQzNCGU7uDDmj2KAjMB_UAEpoWAdwZtxfZ-SBOD60P_bqV5sFrGf6RJuKp1mV5Sw0xUZbkzD1CABZ1GAAd8CYeNkUpCrIs6c3JGAWYozwsD8Cb6yWdK4_YlgmrrECl8y0ZUCOy', 'url' => '#', 'badge' => 'OFERTA', 'badgeColor' => 'red'],
                ['id' => 0, 'name' => 'Minimalist Quartz Watch', 'price' => '$85.00', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA42ppABc4hGwWZBbxUrMyaTjqq244TRzylY-WhZ4f0XVDLg_uQhnCLlCMe78NNHT3G8DGm8cuKpwd27632MyVN9Q2JKJyezWzzNwOrDkHU91vrH_lkLPk0GinsUkzJnlVdNCOvA-o1uqN0-6qvYnaOFzoZvbEhLGxStfjNI5HEBfREDGRVhOOA75Nr5zc2-GOaaRM_RakC60BXRU7qz_MeW5SEQ9XorVdeUvkS15vOnbStlAk8mepDXSt3ZThJOmx32nlyDW8SU86r', 'url' => '#', 'badge' => '', 'badgeColor' => 'red'],
                ['id' => 0, 'name' => 'Polarized Urban Sunglasses', 'price' => '$45.50', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBkMqnoEiR8bzj4kWY1JIdhtf93vtZjQupD5U5HvGq2WYamw9frPcYWlGdm_wS-GszkfcCpng7yWKvv-mo8NaaKKk9Zpczce1xotV3VWB3d5vopiosPfDwN-MnIf_RfWruIEXgVHVRyvQ_aJv8D7qms_dihmpmADKfRzi2XGP9xS2hdakWGp7YcJqzGZjC5MjIjh0TXFri_f8MIqlIbVirkvuRAlkpOTssjtgYLqKhxzfk_WdD7Rwtx18sDZBXEX9irVoLFyjD4AKrf', 'url' => '#', 'badge' => '20% OFF', 'badgeColor' => 'orange'],
                ['id' => 0, 'name' => 'Professional DSLR Camera', 'price' => '$1,100.00', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCCXL9szgLh4Sf-Xl4YNw4PYGVzVd67M4HhI81aJFjISlOHCu6e2-WJbdvIHdbbnOBm-V6BUSTfnKhvh9yTXlTvRjfDiLMX0r5RpYuSctHWdVil0tipBrOAEF-E0hNGasuaFMhTlMLOYZs73i8YXAS8eCMPls60DEkBvpCecLwsE22Wsx89dVnybQk_icaSL7g6TZPd5CQ0Yq5l3B8k0p2RAMn6j1CLphA65SmU2A0iWl_IyYylGd1kGaaCOU5nLsjr5pEq57QTDRcO', 'url' => '#', 'badge' => '', 'badgeColor' => 'red'],
                ['id' => 0, 'name' => 'Premium Smartphone', 'price' => '$999.90', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAhuaV0tXJ2nNyCG4Ai9W2Weian8swuPqrGB6e1XECULwmP4ZBWSZDdkrZ0ndMxBLFf9HmXt9MityZ7erwmGyCquEUgSuVM1LH90axJcvstlpsnsg9b4pJs26nvw-FOttL3CysjHBWfIxjD3voyUHi28HwflG1BSy60f0FHs-kaA9onxphIDJzzcVuK4k4j-ti3sVYIjyIQitlw9rawxAFtotAxw_v5P1DuJFB5NjZRv00TuT6ZxFFQjQDua_rU7gFLAm7BXax3vJo5', 'url' => '#', 'badge' => 'OFERTA', 'badgeColor' => 'red'],
            ];
        }
    }

    public function addToCart(int $productId): void
    {
        if ($productId && function_exists('WC')) {
            WC()->cart->add_to_cart($productId);
            $this->dispatch('cart-updated');
        }
    }
};
?>

<div>
    <section>
        <div class="flex items-center justify-between mb-5 sm:mb-8 px-2">
            <h2 class="text-lg sm:text-2xl font-bold text-secondary tracking-tight">{{ $title }}</h2>
            <a class="text-primary font-bold hover:text-secondary transition-colors flex items-center gap-1 text-sm group" href="{{ $viewAllUrl }}" wire:navigate>
                Ver todos
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-6">
            @foreach($products as $item)
                <div class="bg-white rounded-[1.25rem] flex flex-col subtle-shadow overflow-hidden group hover:shadow-xl transition-all border border-transparent hover:border-slate-100" wire:key="product-{{ $loop->index }}">
                    {{-- Imagen --}}
                    <a href="{{ $item['url'] }}" class="relative aspect-square bg-white overflow-hidden block" wire:navigate>
                        <img
                            alt="{{ $item['name'] }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            src="{{ $item['image'] }}"
                            loading="lazy"
                        />
                        @if($item['badge'])
                            <span class="absolute top-4 left-4 text-white text-[10px] font-black px-2.5 py-1 rounded-md uppercase tracking-wider {{ $item['badgeColor'] === 'orange' ? 'bg-primary' : ($item['badgeColor'] === 'green' ? 'bg-green-500' : 'bg-[#e43f3f]') }}">
                                {{ $item['badge'] }}
                            </span>
                        @endif
                    </a>

                    {{-- Info --}}
                    <div class="p-3 sm:p-5 flex-1 flex flex-col">
                        <a href="{{ $item['url'] }}" wire:navigate>
                            <h3 class="text-secondary font-semibold text-sm line-clamp-2 mb-2 min-h-[40px] hover:text-primary transition-colors">
                                {{ $item['name'] }}
                            </h3>
                        </a>
                        <p class="text-primary font-bold text-lg sm:text-xl mb-4 sm:mb-5">{!! $item['price'] !!}</p>

                        <flux:button
                            wire:click="addToCart({{ $item['id'] }})"
                            wire:loading.attr="disabled"
                            wire:target="addToCart({{ $item['id'] }})"
                            variant="primary"
                            class="!w-full !bg-primary !py-2.5 sm:!py-3 !rounded-xl !font-bold !text-sm hover:!bg-[#d14d15] active:!scale-95 mt-auto"
                        >
                            <span wire:loading.remove wire:target="addToCart({{ $item['id'] }})">Agregar al Carrito</span>
                            <span wire:loading wire:target="addToCart({{ $item['id'] }})">Agregando...</span>
                        </flux:button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
