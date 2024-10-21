<?php

namespace Rahweb\CmsCore\Modules\Blog\Entities;

use Rahweb\CmsCore\Modules\Comment\Entities\Comment;
use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Traits\Searchable;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Blog extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use Seoable;
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'description', 'url', 'title_seo', 'description_seo', 'status', 'parent_id', 'image',
        'author','call_to_action','publish_date','view'
    ];

    public function getItemImageAttribute()
    {
        return FileManager::serveFile(
            'uploads/blog/' . $this->attributes['image']
        );
    }
    public function category()
    {
        return $this->hasOne(BlogCategory::class, 'id', 'parent_id');
    }
    public function getDateAttribute()
    {
        $date = jdate('d F Y', $this->updated_at->timestamp);
        return $date;
    }
    public function getPublishAttribute()
    {
        return jdate('Y/m/d',\Carbon\Carbon::parse(@$this->publish_date)->timestamp);

    }
    public function services()
    {
        return $this->belongsToMany('Rahweb\CmsCore\Modules\Service\Entities\Service', 'service_blog');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('reply_id')->whereStatus(1);
    }
    public function assignService($service)
    {

        return $this->services()->sync($service);
    }
}
