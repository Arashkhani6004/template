<?php

namespace Rahweb\CmsCore\Modules\User\Entities;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\General\Traits\GlobalScopesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Rahweb\CmsCore\Modules\Order\Entities\Order;
use Rahweb\CmsCore\Modules\Service\Entities\Service;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use GlobalScopesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use GlobalScopesTrait;

    protected $fillable = [
        'full_name',
        'mobile',
        'email',
        'avatar',
        'password',
        'show_in_first_page',
        'confirm_code',
        'birthday'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];


    //Relations
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'user_service');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id')->where('order_status', 'paid');
    }


    public function userTypes()
    {
        return $this->hasMany(UserType::class);
    }

    public function syncUserTypes($types)
    {
        $this->userTypes()->whereNotIn('type', $types)->delete();
        foreach ($types as $row) {
            if (!$this->userTypes()->where('type', $row)->first()) {
                $this->userTypes()->create([
                    'type' => $row,
                ]);
            }
        }
    }

    public function getAvatar($size = "big")
    {
        return FileManager::serveFile(
            'uploads/user/' . $size . '/' . $this->attributes['avatar'], 'assets/notfounds/team-img.jpg'
        );
    }
    public function getDashboardAvatar($size = "big")
    {
        return FileManager::serveFile(
            'uploads/user/' . $size . '/' . $this->attributes['avatar'], 'assets/site/images/people.png'
        );
    }

    public function setMobileAttribute($value)
    {
        $this->attributes['mobile'] = NumberHelper::persian2LatinDigit($value);
    }

    public function getFirstPageNameAttribute()
    {
        return $this->attributes['show_in_first_page'] == 1 ? ['title' => 'نمایش در صفحه اول', 'badge' => 'success'] : ['title' => 'عدم نمایش در صفحه اول', 'badge' => 'danger'];

    }

    public function servicesCollection()
    {
        return $this->belongsToMany('Rahweb\CmsCore\Modules\Service\Entities\Service', 'user_service')
            ->select(['title']);
    }
}
