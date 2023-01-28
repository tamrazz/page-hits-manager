<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PageHit;

class Page extends ProjectModel
{
    use HasFactory;

    /**
     * Get the PageHits for the Page.
     */
    public function pageHits()
    {
        return $this->hasMany(PageHit::class);
    }
}
