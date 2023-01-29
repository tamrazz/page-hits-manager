<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class PageHitFilter extends AbstractFilter
{
    public const PAGE_ID = 'pageId';
    public const IP_ADDRESS = 'ipAddress';
    public const VISITED_BEFORE = 'visitedBefore';
    public const VISITED_AFTER = 'visitedAfter';

    protected function getCallbacks(): array
    {
        return [
            self::PAGE_ID => [$this, 'pageId'],
            self::IP_ADDRESS => [$this, 'ipAddress'],
            self::VISITED_BEFORE => [$this, 'visitedBefore'],
            self::VISITED_AFTER => [$this, 'visitedAfter'],
        ];
    }

    public function pageId(Builder $builder, $value)
    {
        $builder->where('page_id', '=', $value);
    }

    public function ipAddress(Builder $builder, $value)
    {
        $builder->where('ip_address', '=', $value);
    }

    public function visitedBefore(Builder $builder, $value)
    {
        $carbon = new Carbon($value);
        $builder->whereDate('visited_at', '<', $carbon->toDateTimeString());
    }

    public function visitedAfter(Builder $builder, $value)
    {
        $carbon = new Carbon($value);
        $builder->whereDate('visited_at', '>=', $carbon->toDateTimeString());
    }

}
