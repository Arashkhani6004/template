<?php

namespace Rahweb\CmsCore\Modules\Service\Entities;

use Rahweb\CmsCore\Modules\Comment\Entities\Comment;
use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Traits\GlobalScopesTrait;
use Rahweb\CmsCore\Modules\General\Traits\Searchable;
use Rahweb\CmsCore\Modules\General\Traits\UrlSetterTrait;
use Rahweb\CmsCore\Modules\Seo\Traits\Seoable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class WorkSample extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use Searchable;
    use Seoable;
    use UrlSetterTrait;
    use GlobalScopesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'description', 'url', 'show_in_first_page', 'double_image',
        'has_page', 'url', 'short_description'
    ];


    public function getDateAttribute()
    {
        $date = jdate('d F Y', $this->updated_at->timestamp);
        return $date;
    }

    public function images()
    {
        return $this->hasMany('Rahweb\CmsCore\Modules\Service\Entities\WorkSampleImage', 'work_sample_id')
            ->orderBy('thumbnail', 'DESC')->orderby('sort', 'ASC');
    }

    public function imagesCollection()
    {
        return $this->hasMany('Rahweb\CmsCore\Modules\Service\Entities\WorkSampleImage', 'work_sample_id')
            ->orderBy('thumbnail', 'DESC')->orderby('sort', 'ASC')->select(['thumbnail', 'work_sample_id', 'image', 'double_image', 'before_image']);
    }
    public function beforeImg()
    {
        return $this->hasOne('Rahweb\CmsCore\Modules\Service\Entities\WorkSampleImage', 'work_sample_id')
            ->orderby('sort', 'ASC')->where('before_image', '1');
    }
    public function AfterImg()
    {
        return $this->hasOne('Rahweb\CmsCore\Modules\Service\Entities\WorkSampleImage', 'work_sample_id')
            ->orderby('sort', 'ASC')->where('before_image', '0');
    }
    public function getImage($size = "medium")
    {
        $image = $this->images()->orderBy('thumbnail', 'DESC')->orderby('sort', 'ASC')->where('before_image','<>', '1')->first();
        return FileManager::serveFile(
            'uploads/work-sample/' . $size . '/' . @$image['image'], 'assets/notfounds/samples-img.jpg');
    }

    public function getBeforeImage($size = "medium")
    {
        $image = $this->images()->orderBy('thumbnail', 'DESC')->orderby('sort', 'ASC')->where('before_image', '1')->first();
        return FileManager::serveFile(
            'uploads/work-sample/' . $size . '/' . @$image['image'], 'assets/notfounds/samples-img.jpg');
    }

    public function thumbnail()
    {
        return $this->hasMany('Rahweb\CmsCore\Modules\Service\Entities\WorkSampleImage', 'work_sample_id')->Show()->orderby('sort', 'ASC');
    }

    public function services()
    {
        return $this->belongsToMany('Rahweb\CmsCore\Modules\Service\Entities\Service', 'service_work_sample');
    }

    public function assignService($service)
    {

        return $this->services()->sync($service);
    }

    public function getFirstPageNameAttribute()
    {
        return $this->attributes['show_in_first_page'] == 1 ? ['title' => 'نمایش در صفحه اول', 'badge' => 'success'] : ['title' => 'عدم نمایش در صفحه اول', 'badge' => 'danger'];
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('reply_id')->whereStatus(1);
    }
}
