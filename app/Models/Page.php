<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\Filterable;
use App\Models\PageHit;

class Page extends ProjectModel
{
    use HasFactory;
    use Filterable;

    /**
     * Get the PageHits for the Page.
     */
    public function pageHits()
    {
        return $this->hasMany(PageHit::class);
    }

    /**
     * Get number of Hits.
     */
    public function countHits()
    {
        return count($this->pageHits);
    }

    /**
     * Get first Hit.
     */
    public function firstHit()
    {
        return $this->pageHits->min('visited_at');
    }

    /**
     * Get first Hit.
     */
    public function lastHit()
    {
        return $this->pageHits->max('visited_at');
    }

}
