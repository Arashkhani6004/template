<?php

namespace Rahweb\CmsCore\Modules\Blog\Entities;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class BlogCategory extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'description', 'url', 'title_seo', 'description_seo', 'status', 'parent_id', 'image',
    ];
    use Seoable;
    public function parent()
    {
        return $this->hasOne(BlogCategory::class, 'id', 'parent_id');
    }
    public function getItemImageAttribute()
    {
        return FileManager::serveFile(
            'uploads/blog-category/' . $this->attributes['image']
        );
    }
    public function getDateAttribute()
    {
        $date = jdate('d F Y', $this->updated_at->timestamp);
        return $date;
    }
    public function getStatusNameAttribute()
    {
        return $this->attributes['status'] == 1 ? ['title' => 'نمایش در منو ', 'badge' => 'success'] : ['title' => 'عدم نمایش در منو ', 'badge' => 'danger'];
    }
}
