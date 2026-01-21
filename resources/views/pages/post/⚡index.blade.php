<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Post;

new #[Layout('layouts::app'), Title('Posts')] class extends Component {

};
?>

<div >

    <!-- Filters Section -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class=" flex ">
                <flux:field>
                    <flux:input
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search by title or content..."
                        icon="magnifying-glass"
                        class="transition-all duration-200"
                    />
                </flux:field>


                <flux:select  wire:model.live="status">
                    <option>All Posts</option>
                    <option>Published</option>
                    <option>Draft</option>
                </flux:select>
            </div>

            <!-- Status Filter -->
            <div>



            </div>



    </div>



    <!-- Posts Grid -->
    <div wire:loading.class="opacity-50 pointer-events-none" class="transition-opacity duration-200">
        @if($this->posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($this->posts as $post)
                    <article
                        wire:key="post-{{ $post->id }}"
                        class="group bg-white dark:bg-zinc-900 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300"
                    >
                        <!-- Image -->
                        <div class="relative h-48 bg-gradient-to-br from-zinc-100 to-zinc-200 dark:from-zinc-800 dark:to-zinc-900 overflow-hidden">
                            @if($post->image)
                                <img
                                    src="{{ $post->image }}"
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    loading="lazy"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif

                            <!-- Status Badge -->
                            <div class="absolute top-3 right-3">
                                <flux:badge
                                    variant="{{ $post->status ? 'success' : 'warning' }}"
                                    class="shadow-lg backdrop-blur-sm"
                                >
                                    {{ $post->status ? 'Published' : 'Draft' }}
                                </flux:badge>
                            </div>

                            <!-- Overlay on hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <!-- Title -->
                            <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 mb-2 line-clamp-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                                {{ $post->title }}
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($post->content), 120) }}
                            </p>

                            <!-- Meta Info -->
                            <div class="flex items-center gap-4 text-xs text-zinc-500 dark:text-zinc-500 mb-4">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span>{{ number_format($post->views) }} views</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-2">
                                <flux:button
                                    href="/post/{{ $post->id }}/edit"
                                    variant="primary"
                                    size="sm"
                                    class="flex-1"
                                >
                                    Edit Post
                                </flux:button>
                                <flux:button
                                    variant="ghost"
                                    size="sm"
                                    icon="eye"
                                    class="text-zinc-600 dark:text-zinc-400"
                                >
                                </flux:button>
                            </div>
                        </div>

                        <!-- Footer with ID -->
                        <div class="px-6 py-3 bg-zinc-50 dark:bg-zinc-800/50 border-t border-zinc-200 dark:border-zinc-700">
                            <span class="text-xs text-zinc-500 dark:text-zinc-500">ID: #{{ $post->id }}</span>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md border border-zinc-200 dark:border-zinc-700 p-4">
                    {{ $this->posts->links() }}
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 p-12">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-zinc-100 dark:bg-zinc-800 rounded-full mb-4">
                        <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-zinc-900 dark:text-zinc-100 mb-2">No posts found</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 mb-6">
                        @if($search || $status !== 'all')
                            Try adjusting your filters or search query.
                        @else
                            Get started by creating your first post.
                        @endif
                    </p>
                    @if($search || $status !== 'all')
                        <flux:button wire:click="clearFilters" variant="primary">
                            Clear Filters
                        </flux:button>
                    @else
                        <flux:button href="/post/create" variant="primary" icon="plus">
                            Create Your First Post
                        </flux:button>
                    @endif
                </div>
            </div>
        @endif
    </div>


</div>

</div>

