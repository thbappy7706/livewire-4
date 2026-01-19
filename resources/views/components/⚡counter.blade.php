<?php

use Livewire\Component;

new class extends Component {
    public $count = 0;

    public function inc()
    {
        $this->count++
    }

    public function dec()
    {
        $this->count--
    }

};
?>

<div>
    <button type="button" wire:click="inc">Increment</button>
    <button type="button" wire:click="dec">Decrement</button>

    <div>
        Counter: {{ $count }}
    </div>
</div>
