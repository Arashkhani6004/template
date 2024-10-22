<?php

namespace Rahweb\CmsCore\Modules\Product\Entities;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Traits\GlobalScopesTrait;
use Rahweb\CmsCore\Modules\General\Traits\Searchable;
use Rahweb\CmsCore\Modules\General\Traits\UrlSetterTrait;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Rahweb\CmsCore\Modules\Product\DTO\ProductCategoryDTO;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProductCategory extends Authenticatable
{
    use Notifiable;
    use GlobalScopesTrait;
    use Searchable;
    use Seoable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'description', 'url', 'active', 'parent_id', 'image', 'show_in_first_page'
    ];
    public function specifications()
    {
        return $this->belongsToMany(Specification::class, 'category_specification')->whereNull('category_specification.deleted_at');
    }
    public function parent()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id')->with('children');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category_product', 'product_category_id');
    }

    public function getActiveNameAttribute()
    {
        return $this->attributes['active'] == 1 ? ['title' => 'نمایش در منو', 'badge' => 'success'] : ['title' => 'عدم نمایش در منو', 'badge' => 'danger'];

    }

    public function getImage($size = "medium")
    {
        return FileManager::serveFile(
            'uploads/product-category/' . $size . '/' . $this->attributes['image'],'assets/notfounds/category-img.jpg'
        );
    }

    public function getDateAttribute()
    {
        $date = jdate('d F Y', $this->updated_at->timestamp);
        return $date;
    }

    public function getFirstPageNameAttribute()
    {
        return $this->attributes['show_in_first_page'] == 1 ? ['title' => 'نمایش در صفحه اول', 'badge' => 'success'] : ['title' => 'عدم نمایش در صفحه اول', 'badge' => 'danger'];
    }
}
