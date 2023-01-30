<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class PageFilter extends AbstractFilter
{
    public const PATH = 'path';
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const CREATED_BEFORE = 'craetedBefore';
    public const CREATED_AFTER = 'craetedAfter';
    public const UPDATED_BEFORE = 'updatedBefore';
    public const UPDATED_AFTER = 'updatedAfter';

    protected function getCallbacks(): array
    {
        return [
            self::PATH => [$this, 'path'],
            self::TITLE => [$this, 'title'],
            self::CONTENT => [$this, 'content'],
            self::CREATED_BEFORE => [$this, 'craetedBefore'],
            self::CREATED_AFTER => [$this, 'craetedAfter'],
            self::UPDATED_BEFORE => [$this, 'updatedBefore'],
            self::UPDATED_AFTER => [$this, 'updatedAfter'],
        ];
    }

    public function path(Builder $builder, $value)
    {
        $builder->where('path', 'like', $value);
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', '%' . $value . '%');
    }

    public function content(Builder $builder, $value)
    {
        $builder->where('content', 'like', '%' . $value . '%');
    }

    public function craetedBefore(Builder $builder, $value)
    {
        $carbon = new Carbon($value);
        $builder->whereDate('created_at', '<', $carbon->toDateTimeString());
    }

    public function craetedAfter(Builder $builder, $value)
    {
        $carbon = new Carbon($value);
        $builder->whereDate('created_at', '>=', $carbon->toDateTimeString());
    }

    public function updatedBefore(Builder $builder, $value)
    {
        $carbon = new Carbon($value);
        $builder->whereDate('updated_at', '<', $carbon->toDateTimeString());
    }

    public function updatedAfter(Builder $builder, $value)
    {
        $carbon = new Carbon($value);
        $builder->whereDate('updated_at', '>=', $carbon->toDateTimeString());
    }

}
