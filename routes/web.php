<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/post');
});

Route::livewire('post/create', 'pages::post.create');
Route::livewire('post', 'pages::post.index');
