<?php

namespace Rahweb\CmsCore\Modules\Comment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rahweb\CmsCore\Modules\Blog\Entities\Blog;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Rahweb\CmsCore\Modules\Service\Entities\WorkSample;
use Rahweb\CmsCore\Modules\User\Entities\User;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = "comments";
    protected $fillable = [
        'mobile',
        'user_id',
        'name',
        'content',
        'commentable_id',
        'commentable_type',
        'reply_id',
        'status',
        'rate',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany('Rahweb\CmsCore\Modules\Comment\Entities\Comment', 'reply_id')->where('status', 1);
    }

    public function comment()
    {
        return $this->hasOne('Rahweb\CmsCore\Modules\Comment\Entities\Comment', 'id', 'reply_id')->withTrashed();
    }

    public function getStatusItemAttribute()
    {
        return $this->attributes['status'] == 1 ? ['title' => 'منتشر شده', 'badge' => 'success'] : ['title' => 'عدم انتشار', 'badge' => 'danger'];
    }

    public function getDateAttribute()
    {
        $date = jdate('d F Y', $this->updated_at->timestamp);
        return $date;
    }

    public function getModelNameAttribute()
    {
        if ($this->commentable_type === Blog::class) {
            return 'مطلب';
        } elseif ($this->commentable_type === Service::class) {
            return 'خدمات';
        } elseif ($this->commentable_type === WorkSample::class) {
            return 'نمونه کار';
        } elseif ($this->commentable_type === Product::class) {
            return 'محصولات';
        } else {
            return '';
        }
    }
}
