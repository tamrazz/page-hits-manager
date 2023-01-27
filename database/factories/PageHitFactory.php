<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Page;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageHit>
 */
class PageHitFactory extends Factory
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

    /**
     * Generate random date between two dates
     *
     * @param string    $startDate  Start date
     * @param string    $endDate    End date
     * @param string    $format     Date format
     * @return bool|string
     */
    public function randomDate($startDate = 'now', $endDate = 'now', $format = 'Y-m-d H:i:s')
    {
        $startTimestamp = strtotime($startDate) ?: time();
        $endTimestamp = strtotime($endDate) ?: time();

        if ($startTimestamp > $endTimestamp) {
            $startTimestamp = $endTimestamp;
        }

        return date($format, mt_rand($startTimestamp, $endTimestamp));
    }
}
