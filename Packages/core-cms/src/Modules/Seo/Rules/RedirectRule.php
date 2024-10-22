<?php
namespace Rahweb\CmsCore\Modules\Seo\Rules;

use Rahweb\CmsCore\Modules\Seo\Entities\SeoMeta;
use Illuminate\Contracts\Validation\Rule;
use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Illuminate\Support\Facades\File;

class RedirectRule implements Rule
{
    protected $old_address;

    public function __construct($old_address)
    {
        $this->old_address = $old_address;

    }

    public function passes($attribute, $value)
    {
      if ($this->old_address == '/')
      {
            return false;
        } else {
            return true;
        }
    }

    public function message()
    {
        return 'نمیتوانید صفحه اول را ریدایرکت کنید';
    }
}
