<?php

use Livewire\Component;

new class extends Component
{
    public string $title = 'Lo que quieres, cuando lo quieres';
    public array $stores = [];
    public string $aspectRatio = '4/5';

    public function mount(string $title = 'Lo que quieres, cuando lo quieres', string $aspectRatio = '4/5'): void
    {
        $this->title = $title;
        $this->aspectRatio = $aspectRatio;

        // Puede cargar desde custom post type o ACF
        if (empty($this->stores)) {
            $this->stores = [
                ['name' => 'ElectroStore', 'offer' => 'Hasta 65% Off', 'badge' => 'Lo más buscado', 'imageUrl' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCCXL9szgLh4Sf-Xl4YNw4PYGVzVd67M4HhI81aJFjISlOHCu6e2-WJbdvIHdbbnOBm-V6BUSTfnKhvh9yTXlTvRjfDiLMX0r5RpYuSctHWdVil0tipBrOAEF-E0hNGasuaFMhTlMLOYZs73i8YXAS8eCMPls60DEkBvpCecLwsE22Wsx89dVnybQk_icaSL7g6TZPd5CQ0Yq5l3B8k0p2RAMn6j1CLphA65SmU2A0iWl_IyYylGd1kGaaCOU5nLsjr5pEq57QTDRcO', 'link' => '#'],
                ['name' => 'Moda Urbana', 'offer' => 'Colección Nueva', 'badge' => 'Premium Partner', 'imageUrl' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCmrj8m9jkCNxW9iWWC-VwU8KnXOOxz4GcLdUErz5uFgDStmVzqQEwSNi1hFtpqv2E_m3GNgacCpBxAs94IjQ94obQ2xBpPHKEOao1cq4icBdu4hdhCFzCoKG9rR_1eR5NVwWdND9HIz8TFfuRVtBW24xVUNEM991nG5EgIws-ad-1oxOw-zkBKlrX2pFk8eIgYHI9SCYeBNpPyl3d7NTzGQDPb0FTR-WwWLWqHDBhPn7VBPzLC9IPcCOaQu_yKHRliV141yC9zEwc0', 'link' => '#'],
                ['name' => 'SuperMarket', 'offer' => 'Precios Bajos Siempre', 'badge' => 'Fresh Quality', 'imageUrl' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAhuaV0tXJ2nNyCG4Ai9W2Weian8swuPqrGB6e1XECULwmP4ZBWSZDdkrZ0ndMxBLFf9HmXt9MityZ7erwmGyCquEUgSuVM1LH90axJcvstlpsnsg9b4pJs26nvw-FOttL3CysjHBWfIxjD3voyUHi28HwflG1BSy60f0FHs-kaA9onxphIDJzzcVuK4k4j-ti3sVYIjyIQitlw9rawxAFtotAxw_v5P1DuJFB5NjZRv00TuT6ZxFFQjQDua_rU7gFLAm7BXax3vJo5', 'link' => '#'],
                ['name' => 'Aventura Pro', 'offer' => 'Equípate con lo Mejor', 'badge' => 'Outdoor Experts', 'imageUrl' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBkMqnoEiR8bzj4kWY1JIdhtf93vtZjQupD5U5HvGq2WYamw9frPcYWlGdm_wS-GszkfcCpng7yWKvv-mo8NaaKKk9Zpczce1xotV3VWB3d5vopiosPfDwN-MnIf_RfWruIEXgVHVRyvQ_aJv8D7qms_dihmpmADKfRzi2XGP9xS2hdakWGp7YcJqzGZjC5MjIjh0TXFri_f8MIqlIbVirkvuRAlkpOTssjtgYLqKhxzfk_WdD7Rwtx18sDZBXEX9irVoLFyjD4AKrf', 'link' => '#'],
            ];
        }
    }
};
?>

<div>
    <section class="relative">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-secondary">{{ $title }}</h2>
        </div>

        <div class="relative group/carousel" x-data>
            {{-- Navigation Arrows --}}
            <button
                x-on:click="$refs.showcaseGrid.scrollBy({left: -400, behavior: 'smooth'})"
                class="absolute left-[-20px] top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white shadow-xl flex items-center justify-center z-20 text-black hover:bg-slate-50 transition-colors border border-slate-100 hidden md:flex"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button
                x-on:click="$refs.showcaseGrid.scrollBy({left: 400, behavior: 'smooth'})"
                class="absolute right-[-20px] top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white shadow-xl flex items-center justify-center z-20 text-black hover:bg-slate-50 transition-colors border border-slate-100 hidden md:flex"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>

            <div
                x-ref="showcaseGrid"
                @class([
                    'grid gap-6 overflow-hidden',
                    'grid-cols-1 md:grid-cols-2 lg:grid-cols-4' => $aspectRatio === '4/5',
                    'grid-cols-1 md:grid-cols-3' => $aspectRatio === '16/9',
                ])
            >
                @foreach($stores as $store)
                    <livewire:⚡store-card
                        :name="$store['name']"
                        :offer="$store['offer']"
                        :badge="$store['badge']"
                        :image-url="$store['imageUrl']"
                        :link="$store['link']"
                        :aspect-ratio="$aspectRatio"
                        :key="'store-'.$loop->index"
                    />
                @endforeach
            </div>
        </div>
    </section>
</div>
