<?php

namespace Database\Factories;

use App\Models\Page;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageHit>
 */
class PageHitFactory extends ProjectFactory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $page_ids = Page::all('id');
        return [
            'ip_address' => $this->faker->ipv4(),
            'page_id' => $this->faker->randomElement($page_ids),
            'visited_at' => $this->randomDate('10.10.2010'),
        ];
    }
}
