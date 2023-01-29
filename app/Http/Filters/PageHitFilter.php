<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class PageHitFilter extends AbstractFilter
{
    public const PAGE_ID = 'pageId';
    public const VISITED_BEFORE = 'visitedBefore';
    public const VISITED_AFTER = 'visitedAfter';

    protected function getCallbacks(): array
    {
        return [
            self::PAGE_ID => [$this, 'pageId'],
            self::VISITED_BEFORE => [$this, 'visitedBefore'],
            self::VISITED_AFTER => [$this, 'visitedAfter'],
        ];
    }

    public function pageId(Builder $builder, $value)
    {
        $builder->where('page_id', '=', $value);
    }

    public function visitedBefore(Builder $builder, $value)
    {
        $builder->whereDate('visited_at', '<', new Carbon($value));
    }

    public function visitedAfter(Builder $builder, $value)
    {
        $builder->whereDate('visited_at', '>=', new Carbon($value));
    }

}
