<?php

namespace Rahweb\CmsCore\Modules\Service\Filters;

use Illuminate\Database\Eloquent\Builder;

class FeeFilter
{
    public function apply(Builder $query, $filters)
    {
        if (isset($filters['title'])) {
            $title = $filters['title'];
            $query->where('title', 'like', '%' . $title . '%');
        }
        return $query;
    }
}
