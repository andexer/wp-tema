<?php

use Livewire\Component;

new class extends Component
{
    public function getSiteNameProperty(): string
    {
        return get_bloginfo('name');
    }

    public function getHomeUrlProperty(): string
    {
        return home_url('/');
    }

    public function getYear(): int
    {
        return (int) date('Y');
    }
};
?>

<div>
    <footer class="bg-secondary text-white/80 border-t border-white/10 overflow-hidden w-full relative m-0 p-0">
        <div class="container mx-auto px-4 lg:px-8 py-4 md:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-4 lg:gap-12">

                {{-- Sobre Nosotros --}}
                <div x-data="{ open: false }" class="border-b border-white/5 md:border-none pb-2 md:pb-0">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-left md:pointer-events-none md:cursor-default group">
                        <flux:subheading class="!text-white/90 !font-bold !text-[9px] uppercase tracking-[0.2em] mb-0 md:mb-6">Sobre Nosotros</flux:subheading>
                        <flux:icon name="chevron-down" variant="micro" class="md:hidden transition-transform duration-300 opacity-30" ::class="open ? 'rotate-180' : ''" />
                    </button>
                    <div x-show="open" x-cloak class="md:!block mt-2 md:mt-0">
                        <ul class="space-y-1 md:space-y-3 text-sm">
                            <li><flux:link href="#" class="!text-white/40 hover:!text-primary !transition-colors !no-underline !text-[10px]">Acerca de nosotros</flux:link></li>
                            <li><flux:link href="#" class="!text-white/40 hover:!text-primary !transition-colors !no-underline !text-[10px]">Contáctanos</flux:link></li>
                        </ul>
                    </div>
                </div>

                {{-- Atención al Cliente --}}
                <div x-data="{ open: false }" class="border-b border-white/5 md:border-none pb-2 md:pb-0">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-left md:pointer-events-none md:cursor-default group">
                        <flux:subheading class="!text-white/90 !font-bold !text-[9px] uppercase tracking-[0.2em] mb-0 md:mb-6">Atención al Cliente</flux:subheading>
                        <flux:icon name="chevron-down" variant="micro" class="md:hidden transition-transform duration-300 opacity-30" ::class="open ? 'rotate-180' : ''" />
                    </button>
                    <div x-show="open" x-cloak class="md:!block mt-2 md:mt-0">
                        <ul class="space-y-1 md:space-y-3 text-sm">
                            <li><flux:link href="#" class="!text-white/40 hover:!text-primary !transition-colors !no-underline !text-[10px]">Términos y Condiciones</flux:link></li>
                            <li><flux:link href="#" class="!text-white/40 hover:!text-primary !transition-colors !no-underline !text-[10px]">Políticas de Privacidad</flux:link></li>
                        </ul>
                    </div>
                </div>

                {{-- Ayuda --}}
                <div x-data="{ open: false }" class="border-b border-white/5 md:border-none pb-2 md:pb-0">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-left md:pointer-events-none md:cursor-default group">
                        <flux:subheading class="!text-white/90 !font-bold !text-[9px] uppercase tracking-[0.2em] mb-0 md:mb-6">Ayuda</flux:subheading>
                        <flux:icon name="chevron-down" variant="micro" class="md:hidden transition-transform duration-300 opacity-30" ::class="open ? 'rotate-180' : ''" />
                    </button>
                    <div x-show="open" x-cloak class="md:!block mt-2 md:mt-0">
                        <ul class="space-y-1 md:space-y-3 text-sm">
                            <li><flux:link href="#" class="!text-white/40 hover:!text-primary !transition-colors !no-underline !text-[10px]">Preguntas Frecuentes</flux:link></li>
                            <li><flux:link href="#" class="!text-white/40 hover:!text-primary !transition-colors !no-underline !text-[10px]">Cómo calcular envío</flux:link></li>
                            <li><flux:link href="#" class="!text-white/40 hover:!text-primary !transition-colors !no-underline !text-[10px]">Rastrea tu paquete</flux:link></li>
                        </ul>
                    </div>
                </div>

                {{-- Descarga & Social --}}
                <div class="grid grid-cols-2 md:flex md:flex-col gap-4 md:gap-0 mt-2 md:mt-0">
                    <div>
                        <flux:subheading class="!text-white/90 !font-bold !text-[9px] uppercase tracking-[0.2em] mb-3 md:mb-6">Descárgala</flux:subheading>
                        <div class="flex flex-col gap-2 mb-2 md:mb-6">
                            <a href="#" class="bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg px-2.5 py-1.5 flex items-center gap-2 transition-all group">
                                <flux:icon name="play" variant="solid" class="w-4 h-4 text-white/60 group-hover:text-primary transition-all shrink-0" />
                                <div class="text-left min-w-0">
                                    <p class="text-[6px] uppercase leading-none text-white/30 truncate">Android</p>
                                    <p class="text-[10px] font-bold leading-none mt-0.5 text-white/90 truncate">Play Store</p>
                                </div>
                            </a>
                            <a href="#" class="bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg px-2.5 py-1.5 flex items-center gap-2 transition-all group">
                                <flux:icon name="device-phone-mobile" variant="solid" class="w-4 h-4 text-white/60 group-hover:text-primary transition-all shrink-0" />
                                <div class="text-left min-w-0">
                                    <p class="text-[6px] uppercase leading-none text-white/30 truncate">iOS App</p>
                                    <p class="text-[10px] font-bold leading-none mt-0.5 text-white/90 truncate">App Store</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <flux:subheading class="!text-white/90 !font-bold !text-[9px] uppercase tracking-[0.2em] mb-3">Síguenos</flux:subheading>
                        <div class="flex gap-2">
                            <a href="#" class="bg-white/5 hover:bg-white/10 p-1.5 rounded-full transition-all border border-white/5 group">
                                <svg class="w-3.5 h-3.5 fill-white/50 group-hover:fill-primary transition-colors" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                            <a href="#" class="bg-white/5 hover:bg-white/10 p-1.5 rounded-full transition-all border border-white/5 group">
                                <svg class="w-3.5 h-3.5 fill-white/50 group-hover:fill-primary transition-colors" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Copyright Final --}}
            <div class="mt-4 pt-4 border-t border-white/5 flex flex-col items-center text-center gap-2">
                <p class="text-[8px] text-white/10 font-medium tracking-widest uppercase">
                    © {{ $this->getYear() }} {{ $this->siteName }}
                </p>
                <div class="flex gap-4">
                    <flux:link href="#" class="!text-[9px] !text-white/20 hover:!text-white !transition-colors !no-underline">Privacidad</flux:link>
                    <flux:link href="#" class="!text-[9px] !text-white/20 hover:!text-white !transition-colors !no-underline">Términos</flux:link>
                </div>
            </div>
        </div>
    </footer>
</div>