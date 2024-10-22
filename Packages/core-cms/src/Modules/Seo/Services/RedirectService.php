<?php

namespace Rahweb\CmsCore\Modules\Seo\Services;

use Rahweb\CmsCore\Modules\Seo\DTO\RedirectDTO;
use \Rahweb\CmsCore\Modules\Seo\Entities\Redirect as RedirectModel;

class RedirectService
{
    public function create(RedirectDTO $redirectDTO)
    {
        RedirectModel::create([
            'old_address' => $redirectDTO->getOldAddress(),
            'new_address' => $redirectDTO->getNewAddress(),
        ]);
    }


    public function destroy(int $id)
    {
        RedirectModel::destroy($id);
    }

    public static function findAll()
    {
        return RedirectModel::orderBy('id', 'DESC')->get();
    }
}
