<?php

namespace Rahweb\CmsCore\Modules\Course\Entities;

use Rahweb\CmsCore\Modules\Comment\Entities\Comment;
use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\General\Traits\UrlSetterTrait;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Rahweb\CmsCore\Modules\User\Entities\User;
use Rahweb\CmsCore\Modules\Lms\Session\Entities\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use Seoable;use UrlSetterTrait;use SoftDeletes;

    protected $fillable = [
        'title',
        'course_category_id',
        'image',
        'teacher_id',
        'hours',
        'minutes',
        'type',
        'price',
        'discounted_price',
        'description',
        'url',
        'h1',
        'active',
    ];

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function getItemImageAttribute()
    {
        if ($this->attributes['image']) {
            return file_exists('assets/uploads/course/' . $this->attributes['image']) ? asset('assets/uploads/course/' . $this->attributes['image']) : asset('assets/notfounds/default.jpg');
        } else {
            return asset('assets/notfounds/default.jpg');
        }
    }

    public function getDateAttribute()
    {
        $date = jdate('d F Y', $this->updated_at->timestamp);
        return $date;
    }

    public function setPriceAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['price'] = NumberHelper::persian2LatinDigit($value);
        }
    }
    public function setDiscountedPriceAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['discounted_price'] = NumberHelper::persian2LatinDigit($value);
        } else {
            $this->attributes['discounted_price'] = 0;
        }
    }

    public function setTimeAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['time'] = NumberHelper::persian2LatinDigit($value);
        }
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getModelNameAttribute()
    {
        return 'دوره ها';
    }
}
