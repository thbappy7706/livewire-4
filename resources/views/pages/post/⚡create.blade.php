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

    <flux:button type="submit" variant="primary"> Save </flux:button>

</form>
