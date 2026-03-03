<?php

use Livewire\Component;

new class extends Component
{
    public array $categories = [];

    public function mount(): void
    {
        if (function_exists('get_terms')) {
            $terms = get_terms([
                'taxonomy'   => 'product_cat',
                'hide_empty' => true,
                'parent'     => 0,
                'number'     => 15,
                'orderby'    => 'count',
                'order'      => 'DESC',
            ]);

            if (!is_wp_error($terms) && !empty($terms)) {
                $this->categories = collect($terms)->map(fn($term) => [
                    'name'  => $term->name,
                    'slug'  => $term->slug,
                    'url'   => get_term_link($term),
                    'count' => $term->count,
                ])->toArray();
            }
        }

        // Fallback si no hay categorías
        if (empty($this->categories)) {
            $this->categories = [
                ['name' => 'Vestuario', 'slug' => 'vestuario', 'url' => '#', 'count' => 0],
                ['name' => 'Belleza', 'slug' => 'belleza', 'url' => '#', 'count' => 0],
                ['name' => 'Hogar', 'slug' => 'hogar', 'url' => '#', 'count' => 0],
                ['name' => 'Juguetes', 'slug' => 'juguetes', 'url' => '#', 'count' => 0],
                ['name' => 'Tecnología', 'slug' => 'tecnologia', 'url' => '#', 'count' => 0],
                ['name' => 'Deportes', 'slug' => 'deportes', 'url' => '#', 'count' => 0],
                ['name' => 'Supermercado', 'slug' => 'supermercado', 'url' => '#', 'count' => 0],
                ['name' => 'Bebés', 'slug' => 'bebes', 'url' => '#', 'count' => 0],
                ['name' => 'Oficina', 'slug' => 'oficina', 'url' => '#', 'count' => 0],
                ['name' => 'Ferretería', 'slug' => 'ferreteria', 'url' => '#', 'count' => 0],
                ['name' => 'Escolar', 'slug' => 'escolar', 'url' => '#', 'count' => 0],
            ];
        }
    }
};
?>

<div class="bg-white shadow-sm border-b border-gray-200 overflow-x-auto no-scrollbar">
    <div class="container mx-auto px-4 lg:px-8 py-3">
        <div class="flex items-center gap-2 text-sm whitespace-nowrap">
            @foreach($categories as $index => $category)
                <a
                    href="{{ $category['url'] }}"
                    @class([
                        'px-4 py-2 rounded-full font-semibold transition-colors',
                        'bg-primary text-white' => $index === 0,
                        'text-slate-600 hover:bg-slate-50 hover:text-primary' => $index !== 0,
                    ])
                    wire:navigate
                >
                    {{ $category['name'] }}
                </a>
            @endforeach
        </div>
    </div>
</div>