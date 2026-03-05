<?php

use Livewire\Component;

new class extends Component
{
    public array $slides = [];

    public function mount(): void
    {
        // Los slides pueden venir de un custom field, opción de WP, o hardcode
        $this->slides = [
            [
                'title'       => 'Lo mejor del mundo<br />en tu puerta.',
                'description' => 'Únete a miles de personas que confían en DeTodo24 para sus compras diarias con los mejores precios del mercado.',
                'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCCXL9szgLh4Sf-Xl4YNw4PYGVzVd67M4HhI81aJFjISlOHCu6e2-WJbdvIHdbbnOBm-V6BUSTfnKhvh9yTXlTvRjfDiLMX0r5RpYuSctHWdVil0tipBrOAEF-E0hNGasuaFMhTlMLOYZs73i8YXAS8eCMPls60DEkBvpCecLwsE22Wsx89dVnybQk_icaSL7g6TZPd5CQ0Yq5l3B8k0p2RAMn6j1CLphA65SmU2A0iWl_IyYylGd1kGaaCOU5nLsjr5pEq57QTDRcO',
                'cta_primary' => ['label' => 'Comprar Ahora', 'url' => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '#'],
                'cta_secondary' => ['label' => 'Ver Promociones', 'url' => '#'],
            ],
        ];
    }
};
?>

<div>
    <section class="container mx-auto px-4 lg:px-8">
        <div
            x-data="{
                current: 0,
                slides: {{ count($slides) }},
                autoplay: null,
                init() {
                    this.autoplay = setInterval(() => this.next(), 6000);
                },
                next() {
                    this.current = (this.current + 1) % this.slides;
                },
                prev() {
                    this.current = (this.current - 1 + this.slides) % this.slides;
                },
                goTo(index) {
                    this.current = index;
                    clearInterval(this.autoplay);
                    this.autoplay = setInterval(() => this.next(), 6000);
                }
            }"
            class="relative rounded-[2rem] sm:rounded-[2rem] rounded-3xl overflow-hidden bg-secondary min-h-[300px] sm:min-h-[400px] md:min-h-[520px] lg:min-h-[580px] shadow-2xl flex items-center"
        >
            @foreach($slides as $index => $slide)
                <div
                    x-show="current === {{ $index }}"
                    x-transition:enter="transition-opacity ease-out duration-700"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-in duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="absolute inset-0"
                >
                    <img
                        alt="Banner"
                        class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-50"
                        src="{{ $slide['image'] }}"
                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                    />
                    <div class="absolute inset-0 bg-gradient-to-r from-secondary via-secondary/95 to-primary/40"></div>
                </div>
            @endforeach

            {{-- Contenido del slide actual --}}
            @foreach($slides as $index => $slide)
                <div
                    x-show="current === {{ $index }}"
                    x-transition:enter="transition ease-out duration-700 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="relative h-full flex flex-col justify-center px-6 sm:px-8 md:px-20 lg:px-32 max-w-5xl text-white py-10 md:py-16"
                >
                    <flux:heading level="1" class="text-2xl sm:text-4xl md:text-6xl lg:text-7xl font-bold leading-[1.1] mb-4 md:mb-6 tracking-tight text-white">
                        {!! $slide['title'] !!}
                    </flux:heading>
                    <p class="text-sm sm:text-lg md:text-xl text-white/90 mb-6 sm:mb-12 max-w-xl leading-relaxed">
                        {{ $slide['description'] }}
                    </p>
                    <div class="flex flex-wrap gap-2 sm:gap-4">
                        <flux:button
                            as="a"
                            href="{{ $slide['cta_primary']['url'] }}"
                            class="!bg-white !text-secondary !px-6 sm:!px-10 !py-3 sm:!py-4 !rounded-xl !font-bold !text-sm sm:!text-base !shadow-lg hover:!bg-slate-100"
                        >
                            {{ $slide['cta_primary']['label'] }}
                        </flux:button>
                        <a href="{{ $slide['cta_secondary']['url'] }}" class="border-2 border-white text-white px-5 sm:px-10 py-2.5 sm:py-4 rounded-xl font-bold hover:bg-white/10 transition-all text-xs sm:text-base">
                            {{ $slide['cta_secondary']['label'] }}
                        </a>
                    </div>
                </div>
            @endforeach

            {{-- Navigation Arrows --}}
            @if(count($slides) > 1)
                <button
                    x-on:click="prev()"
                    class="absolute left-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-black/40 hover:bg-black/60 rounded-full text-white flex items-center justify-center transition-all"
                >
                    <flux:icon name="chevron-left" class="w-6 h-6" />
                </button>
                <button
                    x-on:click="next()"
                    class="absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-black/40 hover:bg-black/60 rounded-full text-white flex items-center justify-center transition-all"
                >
                    <flux:icon name="chevron-right" class="w-6 h-6" />
                </button>

                {{-- Dots --}}
                <div class="absolute bottom-10 right-12 flex items-center gap-2">
                    @foreach($slides as $index => $slide)
                        <button
                            x-on:click="goTo({{ $index }})"
                            :class="current === {{ $index }} ? 'w-8 h-1.5 bg-white' : 'w-1.5 h-1.5 bg-white/40'"
                            class="rounded-full transition-all"
                        ></button>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
