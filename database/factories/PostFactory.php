<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => 'https://picsum.photos/seed/' . $this->faker->numberBetween(1, 1000) . '/800/600',
            'content' => $this->faker->paragraphs(4, true),
            'views' => $this->faker->numberBetween(0, 5000),
            'status' => $this->faker->boolean(80), // 80% active
            'published_at' => $this->faker->optional()->date(),
        ];
    }
}
