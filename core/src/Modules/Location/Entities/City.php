<?php

namespace Rahweb\CmsCore\Modules\Location\Entities;

use Rahweb\CmsCore\Modules\Comment\Entities\Comment;
use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Traits\Searchable;
use Rahweb\CmsCore\Modules\Order\Entities\ShippingMethod;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class City extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use Seoable;
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'status', 'state_id',
    ];

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
    public function shippingMethods()
    {
        return $this->belongsToMany(ShippingMethod::class,"shipping_method_city","city_id","shipping_method_id");
    }
    public function getStatusNameAttribute()
    {
        return $this->attributes['status'] == 1 ? ['title' => 'نمایش  ', 'badge' => 'success'] : ['title' => 'عدم نمایش  ', 'badge' => 'danger'];
    }
}
