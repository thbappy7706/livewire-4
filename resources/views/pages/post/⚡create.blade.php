<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Post;

new #[Layout('layouts::app', ['title' => 'Create Post'])] class extends Component
{
    public $title = '';
    public $content = '';

    public function save()
    {
        Post::create($this->validate([
            'title' => 'required|min:3',
            'content' => 'required'
        ]));

        $this->redirect('/');
    }
};
?>


<form wire:submit="save" class="w-96 space-y-6">
    <flux:input wire:model="title" label="Title" />

    <flux:textarea wire:model="content" label="Content"/>

{{--    <flux:button type="submit" variant="primary" color="teal"> Save </flux:button>--}}

    <div class="flex justify-end">
        <button
            type="submit"
            class="flex items-center gap-2 rounded-md bg-black border border-black
               px-4 py-2 text-xs font-medium tracking-wide text-neutral-100
               transition hover:opacity-75 focus-visible:outline-2
               focus-visible:outline-offset-2 focus-visible:outline-black
               disabled:opacity-75 disabled:cursor-not-allowed
               dark:bg-white dark:border-white dark:text-black
               dark:focus-visible:outline-white
               data-loading:opacity-50">

            <span>Create Post</span>

            <flux:icon.loading
                variant="micro"
                class="not-in-data-loading:hidden"
            />
        </button>
    </div>


</form>
