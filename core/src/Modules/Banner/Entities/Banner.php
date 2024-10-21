<?php

namespace Rahweb\CmsCore\Modules\Banner\Entities;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Traits\GlobalScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Banner extends Model
{
    use Notifiable;
    use SoftDeletes;
    use GlobalScopesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'show_in_first_page', 'title', 'image','image_mobile'
    ];

    public function getImageAttribute()
    {
        return FileManager::serveFile(
            'uploads/banner/big/' . $this->attributes['image'],'assets/notfounds/slider-desktop.jpg'
        );
    }
    public function getImageMobileAttribute()
    {
        return FileManager::serveFile(
            'uploads/banner/big/' . $this->attributes['image_mobile']
        );
    }

    public function getFirstPageNameAttribute()
    {
        return $this->attributes['show_in_first_page'] == 1 ?
            ['title' => 'نمایش در صفحه اول', 'badge' => 'success']
        :
            ['title' => 'عدم نمایش در صفحه اول', 'badge' => 'danger'];
    }
}
