<?php

use App\Models\Post;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

test('example', function () {

    assertDatabaseMissing(Post::class, [
        'title' => 'My First Post',
        'content' => 'This is the content of my first post.',
    ]);

    Livewire::test('pages::post.create')
        ->set('title', 'My First Post')
        ->set('content', 'This is the content of my first post.')
        ->call('save')
        ->assertRedirect('/');

    assertDatabaseHas(Post::class, [
        'title' => 'My First Post',
        'content' => 'This is the content of my first post.',
    ]);
});
