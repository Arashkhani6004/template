<?php

namespace Rahweb\CmsCore\Modules\Product\Entities;

use Rahweb\CmsCore\Modules\Comment\Entities\Comment;
use Rahweb\CmsCore\Modules\Faq\Entities\Faq;
use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Traits\GlobalScopesTrait;
use Rahweb\CmsCore\Modules\General\Traits\Searchable;
use Rahweb\CmsCore\Modules\General\Traits\UrlSetterTrait;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Rahweb\CmsCore\Modules\Tag\Entities\Tag;
use Rahweb\CmsCore\Modules\Product\Entities\ProductSpecification;
use Rahweb\CmsCore\Modules\Product\Entities\Specification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Product extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use GlobalScopesTrait;
    use Searchable;
    use Seoable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'description', 'url', 'brand_id', 'active', 'image',
        'price', 'discounted_price', 'final_price', 'show_in_first_page', 'timer_active', 'end_timer', 'start_timer','stock',
        'main_variant_specification_id'
    ];

    public function getImage($size = "medium")
    {
        return FileManager::serveFile(
            'uploads/product/' . $size . '/' . $this->attributes['image'], 'assets/notfounds/product-img.jpg'
        );
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function getDateAttribute()
    {
        $date = jdate('d F Y', $this->updated_at->timestamp);
        return $date;
    }

    public function calculateDiscount($originalPrice, $discountedPrice)
    {

    }

    public function getPercentAttribute()
    {
        $originalPrice = $this->attributes['price'];
        $discountedPrice = $this->attributes['final_price'];
        if (intval($this->attributes['discounted_price']) != 0) {
            // بررسی اینکه قیمت اولیه نباید صفر یا منفی باشد
            if ($originalPrice <= 0) {
                return 0;
            }
            // محاسبه مقدار تخفیف
            $discountAmount = $originalPrice - $discountedPrice;
            // محاسبه درصد تخفیف
            return round(($discountAmount / $originalPrice) * 100);
        } else {
            return null;
        }
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_product', 'product_id');
    }

    public function related()
    {
        return $this->belongsToMany(Product::class, 'related_product', 'product_id', 'related_product_id');
    }

    public function specifications()
    {
        return $this->belongsToMany(Specification::class, 'product_specification')->whereNull('product_specification.value')
            ->whereNull('product_specification.deleted_at');
    }
    public function mainVariant()
    {
        return $this->hasOne(Specification::class, 'id', 'main_variant_specification_id');
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class,'product_id');
    }
    public function specification_values()
    {
        return $this->belongsToMany(Specification::class, 'product_specification')->whereNotNull('product_specification.value')
            ->whereNull('product_specification.deleted_at');
    }

    public function specification_vals()
    {
        return $this->hasMany(ProductSpecification::class)->whereNotNull('product_specification.value');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('reply_id')->whereStatus(1);
    }

    public function assignCategory($cat)
    {

        return $this->categories()->sync($cat);
    }

    public function getActiveNameAttribute()
    {
        return $this->attributes['active'] == 1 ? ['title' => 'نمایش ', 'badge' => 'success'] : ['title' => 'عدم نمایش ', 'badge' => 'danger'];

    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function faqs()
    {
        return $this->morphMany(Faq::class, 'faqable');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id')->orderBy('thumbnail', 'DESC');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'product_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'product_id');
    }

    public function getFirstPageNameAttribute()
    {
        return $this->attributes['show_in_first_page'] == 1 ? ['title' => 'نمایش در صفحه اول', 'badge' => 'success'] : ['title' => 'عدم نمایش در صفحه اول', 'badge' => 'danger'];
    }
    public function getStockProductAttribute()
    {
        return $this->attributes['stock'] == 0 ? ['title' => 'ناموجود', 'badge' => 'danger'] : ['title' => 'موجودی: ' .$this->attributes['stock'], 'badge' => 'primary'];
    }

    public function getTimerActiveNameAttribute()
    {
        return $this->attributes['timer_active'] == 1 ? ['title' => 'تایمر فعال', 'badge' => 'success'] : ['title' => 'تایمر غیر فعال', 'badge' => 'danger'];
    }

    public function getTimerStatusNameAttribute()
    {
        return $this->attributes['end_timer'] != null ? ['title' => jdate('d F Y H:i', $this->end_timer->timestamp), 'badge' => 'success'] : ['title' => 'بدون تایمر', 'badge' => 'danger'];
    }
}
