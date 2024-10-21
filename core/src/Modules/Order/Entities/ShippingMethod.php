<?php

namespace Rahweb\CmsCore\Modules\Order\Entities;

use Rahweb\CmsCore\Modules\Comment\Entities\Comment;
use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\General\Traits\GlobalScopesTrait;
use Rahweb\CmsCore\Modules\General\Traits\Searchable;
use Rahweb\CmsCore\Modules\General\Traits\UrlSetterTrait;
use Rahweb\CmsCore\Modules\Location\Entities\City;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingMethod extends Model
{
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'price',
        'status',
    ];


    public function getDateAttribute()
    {
        return jdate('d F Y', $this->updated_at->timestamp);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'shipping_method_city');
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = NumberHelper::persian2LatinDigit($value);
    }
    public function getStatusNameAttribute()
    {
        return $this->attributes['status'] == 1 ? ['title' => 'نمایش  ', 'badge' => 'success'] : ['title' => 'عدم نمایش  ', 'badge' => 'danger'];
    }
}
