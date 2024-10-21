<?php

namespace Rahweb\CmsCore\Modules\Tag\Entities;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Traits\GlobalScopesTrait;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Taggable extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tag_id' , 'taggable_id' ,'taggable_type'
    ];
}
