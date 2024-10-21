<?php
namespace Rahweb\CmsCore\Modules\General\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeWhereSearch(Builder $query, $keyword)
    {
        $keywordWithoutSpaces = strtolower(str_replace(' ', '', $keyword));
        return $query->whereRaw("REPLACE(REPLACE(LOWER(title), ' ', ''), '_', '') LIKE '%{$keywordWithoutSpaces}%'");
    }
}

