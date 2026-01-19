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
};
?>

<div>
   <button type="button" wire:click="increment">Increment</button>
   <button type="button" wire:click="decrement">Decrement</button>

    <div>
        Counter: {{ $count }}
    </div>
</div>
