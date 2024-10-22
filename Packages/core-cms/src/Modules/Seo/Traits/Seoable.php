<?php

namespace Rahweb\CmsCore\Modules\Seo\Traits;

trait Seoable
{
    public function seo()
    {
        return $this->morphOne('Rahweb\CmsCore\Modules\Seo\Entities\SeoMeta', 'seoable');
    }

    public function getSeoTitleAttribute()
    {
        return $this->seo ? $this->seo->title_seo : null;
    }

    public function getSeoDescriptionAttribute()
    {
        return $this->seo ? $this->seo->description_seo : null;
    }

    public function getSeoIndexAttribute()
    {
        return $this->seo ? $this->seo->noindex : 0;
    }
}
