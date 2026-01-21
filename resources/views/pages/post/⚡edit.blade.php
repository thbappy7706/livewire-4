<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Post;

new #[Layout('layouts::app'), Title('Edit Post')] class extends Component
{
    public Post $post;

    public string $title = '';
    public string $content = '';
    public bool $status = false;

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->title = (string) $post->title;
        $this->content = (string) $post->content;
        $this->status = (bool) $post->status;
    }

    public function save(): void
    {
        $data = $this->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'status' => 'boolean',
        ]);

        $this->post->update($data);

        // Optimistic UI: show saved state immediately
        $this->dispatch('post-saved');

        session()->flash('success', 'Post updated successfully.');

        $this->redirect('/post', navigate: true);
    }

    public function delete(): void
    {
        $this->post->delete();
        $this->dispatch('post-deleted');
        session()->flash('success', 'Post deleted successfully.');
        $this->redirect('/post', navigate: true);
    }
};
?>

<div class="max-w-2xl space-y-6">
    <flux:heading size="xl">Edit post</flux:heading>

    <form wire:submit="save" class="space-y-6">
        <flux:field>
            <flux:input wire:model.live="title" label="Title" wire:ref="titleInput"/>
            <flux:text class="text-xs text-zinc-500" wire:dirty.class="text-amber-600">Changes are not saved yet.</flux:text>
        </flux:field>

        <flux:textarea wire:model.live="content" rows="8" label="Content"/>

        <flux:checkbox wire:model.boolean.live="status" value="1" label="Published" />

        <div class="flex items-center gap-3">
            <flux:button type="submit" variant="primary" data-loading:opacity-50>
                <span>Save</span>
                <flux:icon.loading class="not-in-data-loading:hidden"/>
            </flux:button>

            <flux:button type="button" variant="primary" x-data @click="$wire.$refs.titleInput && $wire.$refs.titleInput.focus()">Focus title</flux:button>

            <flux:button type="button" variant="danger" x-data @click="$dispatch('confirm-delete')">Delete</flux:button>
        </div>
    </form>

    <!-- Delete Confirmation Modal using Islands (lazy) -->
    <div wire:island.lazy wire:key="delete-modal">
        <flux:modal name="delete-post" show-on="confirm-delete">
            <div class="p-4 space-y-4">
                <flux:heading size="lg">Delete this post?</flux:heading>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">This action cannot be undone.</p>
                <div class="flex justify-end gap-2">
                    <flux:button variant="primary" @click="$dispatch('close-modal', { name: 'delete-post' })">Cancel</flux:button>
                    <flux:button variant="danger" wire:click="delete" data-loading:opacity-50>
                        <span>Delete</span>
                        <flux:icon.loading class="not-in-data-loading:hidden"/>
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    </div>
</div>
