<?php

namespace Rahweb\CmsCore\Modules\Blog\Filters;

use Illuminate\Database\Eloquent\Builder;

class BlogFilter
{
    public function apply(Builder $query, $filters)
    {
        if (isset($filters['title'])) {
            $title = $filters['title'];
            $query->where('title', 'like', '%' . $title . '%');
        }

        if (isset($filters['parent_id'])) {
            $parent_id = $filters['parent_id'];
            $query->where('parent_id', 'like', '%' . $parent_id . '%');
        }
        return $query;
    }
}
