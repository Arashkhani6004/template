<?php

namespace Rahweb\CmsCore\Modules\Comment\Filters;

use Illuminate\Database\Eloquent\Builder;

class CommentFilter
{
    public function apply(Builder $query, $filters)
    {

        // to do filte comment

        return $query;
    }
}
