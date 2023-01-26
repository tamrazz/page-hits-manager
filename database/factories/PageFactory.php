<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(random_int(1, 5));
        $path_prefix = '/';
        for ($i=0; $i < random_int(0, 3); $i++) {
            $path_prefix .= $this->faker->word() . '/';
        }
        return [
            'path' => $path_prefix . Str::slug($title),
            'title' => $title,
            'content' => $this->faker->text(),
        ];
    }
}
