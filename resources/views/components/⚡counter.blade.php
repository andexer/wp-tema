<?php

use Livewire\Component;

new class extends Component
{
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function reset(...$properties)
    {
        $this->count = 0;
    }
};
?>

<div>
    <flux:card class="flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold">{{ $count }}</h1>
        <flux:button wire:click="increment" color="primary">Increment +1</flux:button>
        <flux:button wire:click="decrement" color="secondary">Decrement -1</flux:button>
        <flux:button wire:click="reset" color="danger">Reset 0</flux:button>
    </flux:card>
</div>