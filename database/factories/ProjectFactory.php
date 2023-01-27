<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageHit>
 */
abstract class ProjectFactory extends Factory
{
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
