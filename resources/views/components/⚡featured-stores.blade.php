<?php

use Livewire\Component;

new class extends Component
{
    public array $stores = [];

    public function mount(): void
    {
        // Puede cargar desde un custom post type o ACF
        $this->stores = [
            ['name' => 'Apple Store', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDtxwKHEG6qreZe41_7TSPZCwEot3niPl2I_4V5kdXI2KzSObYF2um4h1VRDw1BtuMoOUtBjNv0Fri5-SQFbo3wISDBNRhJ3pPInYQUCLAYIqQc21r3PFP9zGBaSTeI7ra-Zcp-M0LOawFJSCwi_zpxa3XOfgyEE9MIJ5yonf4AwFsR9LaAVVOADJkCYrzCVKnlvMfWeQQa0AZbp15_knMvmDaunJdMSexIcYb62MR9AUOb2P4N_d0hL-GVNSa8PeKwlb7RTlIgN7UV', 'url' => '#'],
            ['name' => 'Nike', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuADpiNbDwaETqu9RkE7ZI9obJ9SP4DC_u-bZThMlI8hHbLqVBiTOw441g8BoV4tY_AwZOwd1n6NL0uF25pn2I60FdZKvWMe_yuHl4Y1d7wL8ba9yxHQz5LLFo-h9hVgR-u9TDHE4FKKJQtvWR1rD7wBii1J0mCbXF_3pB5Q4oqPyLsjWof_A93kw65O3Vx54iUhUk1Gc2MiXCg6AqqafRnSxPdUxPjK49LG_33n-yJc2b1dO-g_rb-j0UNrPAK2B6khld8_mDuSgsz4', 'url' => '#'],
            ['name' => 'Samsung', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDsV9_-pXhHRjSYqf0uKVtNFDW8k-I6ubwYVkdUnMsow_NdI0dje3HatCgjbUXxFtWXOO4Y0bA418OUlw2TRuN9_U2l4z60PfeAH6mV3WYlrTJR2ylwigXOqKm51RA1aqjfstVJgPo3DMOIQbc53tg1Q2CQZyG0aKphSOqHujfofYptnT6rIsRBbyFMpHA9reZFE9hlTwg_v8Xp2ZHAT5D_J3WBAzbRPPRIMQC9xtjt2nAsuC-9BpFctrkbOfwSC0T0bsiaQF4rUKmf', 'url' => '#'],
            ['name' => 'Adidas', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDJmDv7k4Us9mocmaqYFQF7j0Pv5VNRy02ep2kI8WC31rmFr4huy8DLudbbv7hMuS9SblcwhpGSF37Dk_3SXB9pbSdbWLxa0juz59iPB6yAErjq-lvJMIm8Reg2YysC04qoll6qJJJ0RYESjBrMfJ6u3pOG1OeyIlugoC8MGn4webtxAOjf-aP0BVm8T5q18A109XVAlE8XSFHZiLCwRLDL5FIHG_fGCVwx3xzl8r6MsK-tJkR6_he4A_r3zSlIaZh28_PM9Cqd0bxk', 'url' => '#'],
            ['name' => 'Sony', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD4X_DgP2HgIY6uH8JFYVr0zD5fS60p046g02nYntBPwEV1a7ZriQNUVnDvLOmRmZjfksN9IEga0KUObI4a4i2vso0g2r2vC0GErEBsnKDkzIM9QicYN_rX0Q-aWUkiDFiSWZPsvx104dHpG313jYjlHTv1P9MPJk3g4vTecfbtymzs4qCrQk3DfiDI3n5HjA1wq0PFHfchORIKv6bp7q8HFRj8LK0hnoS0Q_myzibE1pcQZslCSuefhDFiV5YsEKtJrLmis7hg97v0', 'url' => '#'],
            ['name' => 'Zara', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCCXL9szgLh4Sf-Xl4YNw4PYGVzVd67M4HhI81aJFjISlOHCu6e2-WJbdvIHdbbnOBm-V6BUSTfnKhvh9yTXlTvRjfDiLMX0r5RpYuSctHWdVil0tipBrOAEF-E0hNGasuaFMhTlMLOYZs73i8YXAS8eCMPls60DEkBvpCecLwsE22Wsx89dVnybQk_icaSL7g6TZPd5CQ0Yq5l3B8k0p2RAMn6j1CLphA65SmU2A0iWl_IyYylGd1kGaaCOU5nLsjr5pEq57QTDRcO', 'url' => '#'],
            ['name' => 'Lego', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCmrj8m9jkCNxW9iWWC-VwU8KnXOOxz4GcLdUErz5uFgDStmVzqQEwSNi1hFtpqv2E_m3GNgacCpBxAs94IjQ94obQ2xBpPHKEOao1cq4icBdu4hdhCFzCoKG9rR_1eR5NVwWdND9HIz8TFfuRVtBW24xVUNEM991nG5EgIws-ad-1oxOw-zkBKlrX2pFk8eIgYHI9SCYeBNpPyl3d7NTzGQDPb0FTR-WwWLWqHDBhPn7VBPzLC9IPcCOaQu_yKHRliV141yC9zEwc0', 'url' => '#'],
            ['name' => 'Disney', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAhuaV0tXJ2nNyCG4Ai9W2Weian8swuPqrGB6e1XECULwmP4ZBWSZDdkrZ0ndMxBLFf9HmXt9MityZ7erwmGyCquEUgSuVM1LH90axJcvstlpsnsg9b4pJs26nvw-FOttL3CysjHBWfIxjD3voyUHi28HwflG1BSy60f0FHs-kaA9onxphIDJzzcVuK4k4j-ti3sVYIjyIQitlw9rawxAFtotAxw_v5P1DuJFB5NjZRv00TuT6ZxFFQjQDua_rU7gFLAm7BXax3vJo5', 'url' => '#'],
        ];
    }
};
?>

<div>
    <section class="relative">
        <div class="flex items-center justify-between mb-8 px-2">
            <h3 class="text-xs font-bold text-secondary uppercase tracking-[0.25em]">TIENDAS DESTACADAS</h3>
            <div class="flex gap-2">
                <flux:button variant="ghost" icon="chevron-left" class="!w-10 !h-10 !rounded-full !border !border-slate-200 !bg-white !text-slate-400 hover:!text-secondary hover:!border-secondary !shadow-sm" x-on:click="$refs.storeScroller.scrollBy({left: -300, behavior: 'smooth'})" />
                <flux:button variant="ghost" icon="chevron-right" class="!w-10 !h-10 !rounded-full !border !border-slate-200 !bg-white !text-slate-400 hover:!text-secondary hover:!border-secondary !shadow-sm" x-on:click="$refs.storeScroller.scrollBy({left: 300, behavior: 'smooth'})" />
            </div>
        </div>

        <div x-ref="storeScroller" class="flex gap-4 sm:gap-6 overflow-x-auto no-scrollbar pb-4 px-4 sm:px-0 scroll-smooth snap-x snap-mandatory">
            @foreach($stores as $store)
                <a href="{{ $store['url'] }}" class="flex-shrink-0 w-[100px] sm:w-[140px] group cursor-pointer text-center snap-start" wire:navigate>
                    <div class="w-full aspect-square bg-white rounded-xl sm:rounded-2xl flex items-center justify-center p-4 sm:p-8 mb-3 sm:mb-4 product-card-shadow transition-all group-hover:shadow-md">
                        <img
                            alt="{{ $store['name'] }}"
                            class="max-w-full max-h-full object-contain"
                            src="{{ $store['image'] }}"
                            loading="lazy"
                        />
                    </div>
                    <span class="text-xs sm:text-sm font-medium text-slate-800 transition-colors group-hover:text-primary truncate block px-1">{{ $store['name'] }}</span>
                </a>
            @endforeach
        </div>
    </section>
</div>
