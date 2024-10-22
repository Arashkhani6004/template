<?php
namespace Rahweb\CmsCore\Modules\Seo\Rules;

use Rahweb\CmsCore\Modules\Seo\Entities\Canonical;
use Rahweb\CmsCore\Modules\Seo\Entities\SeoMeta;
use Illuminate\Contracts\Validation\Rule;
use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Illuminate\Support\Facades\File;

class CanonicalRule implements Rule
{
    protected $url;
    protected $id;

    public function __construct($url,$id)
    {
        $this->url = $url;
        $this->id = $id;

    }

    public function passes($attribute, $value)
    {
        $check = Canonical::where('url', $this->url)->where('id', '<>', $this->id)->first();
      if ($check != null)
      {
            return false;
        } else {
            return true;
        }
    }

    public function message()
    {
        return 'قبلا برای این صفحه کنونیکال تعیین کردید';
    }
}
