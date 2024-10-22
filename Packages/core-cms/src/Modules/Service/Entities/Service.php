<?php

namespace Rahweb\CmsCore\Modules\Service\Entities;

use Rahweb\CmsCore\Modules\Comment\Entities\Comment;
use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\General\Traits\GlobalScopesTrait;
use Rahweb\CmsCore\Modules\General\Traits\Searchable;
use Rahweb\CmsCore\Modules\General\Traits\UrlSetterTrait;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    use Seoable;
    use UrlSetterTrait;
    use GlobalScopesTrait;
    use Searchable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'url',
        'status',
        'parent_id',
        'image',
        'show_in_first_page',
        'show_in_layout',
        'header_image',
        'phone_number',
        'short_description',
    ];

    public function parent()
    {
        return $this->hasOne(Service::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Service::class, 'parent_id')->with('children');
    }
    public function fees()
    {
        return $this->hasMany(Fee::class, 'service_id')->orderBy('minimum_price','ASC');
    }

    public function samples()
    {
        return $this->belongsToMany('Rahweb\CmsCore\Modules\Service\Entities\WorkSample');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('reply_id')->whereStatus(1);
    }

    public function getDateAttribute()
    {
        return jdate('d F Y', $this->updated_at->timestamp);
    }

    public function getShowNameAttribute()
    {
        $text = [];
        if($this->attributes['show_in_first_page']){
            $text[] = "نمایش در صفحه اول";
        }
        if($this->attributes['show_in_layout']){
            $text[] = "نمایش در منو و فوتر";
        }
        return $text;
    }
    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_service');
    }
    public function blogs()
    {
        return $this->belongsToMany('Rahweb\CmsCore\Modules\Blog\Entities\Blog', 'service_blog');
    }
    public function getImageAttribute()
    {
        return FileManager::serveFile(
            'uploads/service/big/' . $this->attributes['image'],'assets/notfounds/services-img.jpg'
        );
    }
    public function getHeaderImageAttribute()
    {
        return FileManager::serveFile(
            'uploads/service/' . $this->attributes['header_image'],'assets/notfounds/service-header-detail.jpg'
        );
    }
    public function setPhoneNumberAttribute($value)
    {
        $this->attributes['phone_number'] = NumberHelper::persian2LatinDigit($value);
    }
}
