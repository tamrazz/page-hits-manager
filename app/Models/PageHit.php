<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Page;
use App\Models\Traits\Filterable;

class PageHit extends ProjectModel
{
    use HasFactory;
    use Filterable;

    const UPDATED_AT = null;
    const CREATED_AT = 'visited_at';

    protected $fillable = [
        'page_id',
        'ip_address',
        'visited_at',
    ];

    /**
     * Get the Page that owns the PageHits.
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

}
