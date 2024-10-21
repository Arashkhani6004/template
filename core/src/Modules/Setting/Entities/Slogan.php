<?php

namespace Rahweb\CmsCore\Modules\Setting\Entities;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\General\Traits\GlobalScopesTrait;
use Rahweb\CmsCore\Modules\General\Traits\UrlSetterTrait;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Slogan extends Model
{
    use Notifiable;
    use UrlSetterTrait;
    use GlobalScopesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value', 'icon', 'active'
    ];

    public function getImageAttribute()
    {
        return FileManager::serveFile(
            'uploads/setting/' . $this->attributes['icon'],'assets/notfounds/default.jpg'
        );
    }
    public function getDateAttribute()
    {
        $date = jdate('d F Y', $this->updated_at->timestamp);
        return $date;
    }
    public function getActiveNameAttribute()
    {
        return $this->attributes['active'] == 1 ? ['title'=> 'نمایش در صفحه ' , 'badge'=>'success']  : ['title'=> 'عدم نمایش در صفحه ' , 'badge'=>'danger'];

    }
}
