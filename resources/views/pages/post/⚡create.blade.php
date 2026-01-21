<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Post;

new #[Layout('layouts::app', ['title' => 'Create Post'])] class extends Component
{
    public $title = '';
    public $content = '';
    public $status = false;

    public function save()
    {
        Post::create($this->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'status' => 'nullable|boolean',
        ]));

        session()->flash('success', 'Post created successfully.');

        $this->redirect('/', navigate: true);
    }
};
?>


<div class="max-w-2xl">
    <form wire:submit="save" class="w-96 space-y-6">
        <flux:input wire:model="title" label="Title" />

        <flux:textarea wire:model="content" label="Content"/>

        <flux:fieldset>
            <flux:legend>Choose Status</flux:legend>
            <div class="flex gap-4 *:gap-x-2">
                <flux:checkbox  value="1"  wire:model.boolean="status" label="Published" />
            </div>
        </flux:fieldset>



    {{--    <flux:button type="submit" variant="primary" color="teal"> Save </flux:button>--}}

        <div class="flex justify-end">
            <button
                type="button"
                x-data
                @click="$dispatch('confirm-create')"
                class="flex items-center gap-2 rounded-md bg-black border border-black
                   px-4 py-2 text-xs font-medium tracking-wide text-neutral-100
                   transition hover:opacity-75 focus-visible:outline-2
                   focus-visible:outline-offset-2 focus-visible:outline-black
                   disabled:opacity-75 disabled:cursor-not-allowed
                   dark:bg-white dark:border-white dark:text-black
                   dark:focus-visible:outline-white">

                <span>Create Post</span>
            </button>
        </div>


    </form>

    <!-- Create Confirmation Modal (lazy island) -->
    <div wire:island.lazy wire:key="create-modal">
        <flux:modal name="create-post" show-on="confirm-create">
            <div class="p-4 space-y-4">
                <flux:heading size="lg">Create this post?</flux:heading>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">Please confirm you want to create this post.</p>
                <div class="flex justify-end gap-2">
                    <flux:button variant="primary" @click="$dispatch('close-modal', { name: 'create-post' })">Cancel</flux:button>
                    <flux:button variant="primary" wire:click="save" data-loading:opacity-50>
                        <span>Confirm</span>
                        <flux:icon.loading class="not-in-data-loading:hidden" />
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    </div>
</div>
