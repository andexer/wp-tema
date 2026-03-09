@foreach ( $notices as $notice )
<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-transition:leave="transition ease-in duration-300" 
    x-transition:leave-start="opacity-100 transform scale-100" 
    x-transition:leave-end="opacity-0 transform scale-95" 
    class="mb-6 bg-blue-50 border border-blue-200/60 shadow-sm shadow-blue-500/5 text-blue-800 px-4 py-3 rounded-2xl flex items-center justify-between gap-3 max-w-2xl mx-auto"
>
    <div class="flex items-center gap-3">
        <div class="bg-blue-100 text-blue-600 p-1.5 rounded-full shrink-0">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div class="text-sm font-semibold tracking-tight">
            {!! wc_kses_notice( $notice['notice'] ) !!}
        </div>
    </div>
    <button @click="show = false" class="text-blue-500 hover:bg-blue-100 hover:text-blue-700 transition-colors focus:outline-none rounded-xl p-1.5 shrink-0">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
</div>
@endforeach
