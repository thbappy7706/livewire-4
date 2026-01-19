<?php

use Livewire\Component;

new class extends Component {
    public $count = 0;

    public function inc()
    {
        $this->count++;
    }

    public function dec()
    {
        $this->count--;
    }

};
?>


    <div class="max-w-sm bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">

     <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900 mb-5">  Counter: {{ $count }}</h5>


        <button wire:click="inc" type="button" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-green-600 rounded-md hover:bg-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-green-700 focus:shadow-outline focus:outline-none">
            Increment
        </button>

        <button wire:click="dec" type="button" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-yellow-500 rounded-md hover:bg-yellow-600 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600 focus:shadow-outline focus:outline-none">
            Decrement
        </button>

    </div>




<script>
    alert('Counter component loaded');
</script>
