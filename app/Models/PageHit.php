<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Page;

class PageHit extends ProjectModel
{
    use HasFactory;

    const UPDATED_AT = null;
    const CREATED_AT = 'visited_at';

    /**
     * Get the Page that owns the PageHits.
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
