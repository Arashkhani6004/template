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

class ProductVariant extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use GlobalScopesTrait;
    use Searchable;
    use Seoable;
    protected $appends = ['percent'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'product_id',
        'price', 'discounted_price', 'final_price', 'price_affective','stock',
        'specification_parent_id','specification_id'
    ];

    public function specification()
    {
        return $this->hasOne(Specification::class, 'id', 'specification_id');
    }



    public function calculateDiscount($originalPrice, $discountedPrice)
    {

    }
    public function images()
    {
        return $this->hasManyThrough(
            Image::class,
            Specification::class,
            'id',                 // local key در جدول Specification
            'specification_id',    // foreign key در جدول Image
            'specification_id',    //foreign key  در جدول ProductVariant
            'id'                  // local key در جدول Image
        )->where('product_id',$this->attributes['product_id']);
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

}
