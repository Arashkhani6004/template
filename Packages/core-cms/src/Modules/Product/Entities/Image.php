<?php

namespace Rahweb\CmsCore\Modules\Product\Entities;

use Rahweb\CmsCore\Modules\Comment\Entities\Comment;
use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Traits\UrlSetterTrait;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Image extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image', 'thumbnail', 'product_id', 'active','specification_id'

    ];

    public function getImage($size = "medium")
    {
        return FileManager::serveFile(
            'uploads/product/' . $size . '/' . $this->attributes['image'], 'assets/notfounds/product-img.jpg'
        );
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getDateAttribute()
    {
        $date = jdate('d F Y', $this->updated_at->timestamp);
        return $date;
    }

    public function getActiveNameAttribute()
    {
        return $this->attributes['active'] == 1 ? ['title' => 'نمایش ', 'badge' => 'success'] : ['title' => 'عدم نمایش ', 'badge' => 'danger'];
    }

    public function getThumbnailNameAttribute()
    {
        return $this->attributes['thumbnail'] == 1 ? ['title' => 'عکس تامبنیل ', 'badge' => 'success'] : ['title' => 'عکس معمولی ', 'badge' => 'danger'];
    }

}
