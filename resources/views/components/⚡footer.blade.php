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
    <footer class="bg-secondary text-white/80 border-t border-white/10">
        <div class="container mx-auto px-4 lg:px-8 py-12 md:py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 md:gap-12">

                {{-- Sobre Nosotros --}}
                <div>
                    <h4 class="text-white font-bold text-xl mb-6 md:mb-8">Sobre Nosotros</h4>
                    <ul class="space-y-3 md:space-y-4 text-sm">
                        <li>
                            <flux:link href="#" class="!text-white/80 hover:!text-white !transition-colors !no-underline">
                                Acerca de {{ $this->siteName }}
                            </flux:link>
                        </li>
                        <li>
                            <flux:link href="#" class="!text-white/80 hover:!text-white !transition-colors !no-underline">
                                Contáctanos
                            </flux:link>
                        </li>
                    </ul>
                </div>

                {{-- Atención al Cliente --}}
                <div>
                    <h4 class="text-white font-bold text-xl mb-6 md:mb-8">Atención al Cliente</h4>
                    <ul class="space-y-3 md:space-y-4 text-sm">
                        <li>
                            <flux:link href="#" class="!text-white/80 hover:!text-white !transition-colors !no-underline">
                                Términos y Condiciones
                            </flux:link>
                        </li>
                        <li>
                            <flux:link href="#" class="!text-white/80 hover:!text-white !transition-colors !no-underline">
                                Políticas de Privacidad
                            </flux:link>
                        </li>
                    </ul>
                </div>

                {{-- Ayuda --}}
                <div>
                    <h4 class="text-white font-bold text-xl mb-6 md:mb-8">Ayuda</h4>
                    <ul class="space-y-3 md:space-y-4 text-sm">
                        <li>
                            <flux:link href="#" class="!text-white/80 hover:!text-white !transition-colors !no-underline">
                                Preguntas Frecuentes
                            </flux:link>
                        </li>
                        <li>
                            <flux:link href="#" class="!text-white/80 hover:!text-white !transition-colors !no-underline">
                                Cómo calcular tu envío
                            </flux:link>
                        </li>
                        <li>
                            <flux:link href="#" class="!text-white/80 hover:!text-white !transition-colors !no-underline">
                                Asóciate con {{ $this->siteName }}
                            </flux:link>
                        </li>
                        <li>
                            <flux:link href="#" class="!text-white/80 hover:!text-white !transition-colors !no-underline">
                                Rastrea tu paquete
                            </flux:link>
                        </li>
                        <li>
                            <flux:link href="#" class="!text-white/80 hover:!text-white !transition-colors !no-underline">
                                Cómo realizar tu pedido
                            </flux:link>
                        </li>
                    </ul>
                </div>

                {{-- Descarga & Contacto --}}
                <div class="flex flex-col">
                    <h4 class="text-white font-bold text-xl mb-6 md:mb-8">Descarga</h4>
                    <div class="space-y-2 mb-6 md:mb-8 text-sm">
                        <p>Tu experiencia de compra completa.</p>
                        <p>Disponible para todos los dispositivos.</p>
                        <p class="font-light italic">¡Descárgala ahora!</p>
                    </div>

                    {{-- App Store Links --}}
                    <div class="flex flex-col gap-4 mb-8 md:mb-10">
                        <a class="bg-black/40 hover:bg-black/60 border border-white/10 rounded-xl px-5 py-2.5 flex items-center gap-4 transition-all max-w-[200px]" href="#">
                            <svg class="w-7 h-7 fill-white shrink-0" viewBox="0 0 512 512">
                                <path d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l236.6-236.6L47 0zm396.6 227.3c27.9 16 43.1 34.1 43.1 54.7s-15.1 38.7-43 54.7l-94.7-54.7 94.6-54.7zM325.3 277.7L410.5 363 104.6 499l220.7-221.3z"></path>
                            </svg>
                            <div class="text-left">
                                <p class="text-[10px] uppercase leading-none opacity-70">Android app on</p>
                                <p class="text-base font-bold leading-none mt-1.5">Google Play</p>
                            </div>
                        </a>
                        <a class="bg-black/40 hover:bg-black/60 border border-white/10 rounded-xl px-5 py-2.5 flex items-center gap-4 transition-all max-w-[200px]" href="#">
                            <svg class="w-7 h-7 fill-white shrink-0" viewBox="0 0 384 512">
                                <path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"></path>
                            </svg>
                            <div class="text-left">
                                <p class="text-[10px] uppercase leading-none opacity-70">Download on the</p>
                                <p class="text-base font-bold leading-none mt-1.5">App Store</p>
                            </div>
                        </a>
                    </div>

                    {{-- Redes Sociales --}}
                    <h5 class="text-white font-bold text-sm mb-5">Contactar a {{ $this->siteName }}</h5>
                    <div class="flex gap-4 md:gap-5">
                        {{-- Instagram --}}
                        <a class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary hover:text-white transition-all" href="#">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path>
                            </svg>
                        </a>
                        {{-- Facebook --}}
                        <a class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary hover:text-white transition-all" href="#">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
                            </svg>
                        </a>
                        {{-- X/Twitter --}}
                        <a class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary hover:text-white transition-all" href="#">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 1200 1227">
                                <path d="M714.163 519.284L1160.89 0H1055.03L667.137 450.887L357.328 0H0L468.492 681.821L0 1226.37H105.866L515.491 750.218L842.672 1226.37H1200L714.137 519.284H714.163ZM569.165 687.828L521.697 619.934L144.011 79.6944H306.615L611.412 515.685L658.88 583.579L1055.08 1150.3H892.476L569.165 687.854V687.828Z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="mt-12 md:mt-20 pt-8 md:pt-10 border-t border-white/5 text-center">
                <p class="text-xs text-white/40 font-medium tracking-wide">
                    © {{ $this->getYear() }} {{ $this->siteName }}. Todos los derechos reservados. Tu tienda de confianza.
                </p>
            </div>
        </div>
    </footer>
</div>
