<?php

namespace Rahweb\CmsCore\Modules\Faq\Entities;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rahweb\CmsCore\Modules\User\Entities\User;
use function Rahweb\CmsCore\Modules\Comment\Entities\jdate;

class Faq extends Model
{
    use SoftDeletes;


    protected $table = "faqs";
    protected $fillable = [
        'question',
        'answer',
        'faqable_id',
        'faqable_type',
        'active',

    ];
    public function faqable()
    {
        return $this->morphTo();
    }


}
