<?php

namespace Rahweb\CmsCore\Modules\Order\Entities;

use Rahweb\CmsCore\Modules\Comment\Entities\Comment;
use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Traits\Searchable;
use Rahweb\CmsCore\Modules\General\Traits\UrlSetterTrait;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Bank extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use Searchable;
    use Seoable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'icon', 'status', 'bank_type', 'config',

    ];
    public function getItemImageAttribute()
    {
        return (asset('assets/site/bank/'.$this->attributes['icon']));
    }

    public function getDateAttribute()
    {
        $date = jdate('d F Y', $this->updated_at->timestamp);
        return $date;
    }
    public function getStatusNameAttribute()
    {
        return $this->attributes['status'] == 1 ? ['title' => 'نمایش ', 'badge' => 'success'] : ['title' => 'عدم نمایش ', 'badge' => 'danger'];
    }
    public function scopeActive($query)
    {
         return $query->whereStatus('1');


    }

}
