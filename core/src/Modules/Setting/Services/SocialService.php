<?php
namespace Rahweb\CmsCore\Modules\Setting\Services;

use Rahweb\CmsCore\Modules\Setting\DTO\SocialDTO;
use Rahweb\CmsCore\Modules\Setting\Entities\Social;

class SocialService
{
    public static function findAll()
    {
        return Social::orderBy('id','DESC')->get();
    }
    public function create(SocialDTO $socialDTO)
    {
        return Social::create([
            'icon' => $socialDTO->getIcon(),
            'link' => $socialDTO->getLink(),
        ]);
    }
    public function update(int $id, SocialDTO $socialDTO)
    {
        $social = Social::findOrfail($id);
        $social->update([
            'icon' => $socialDTO->getIcon(),
            'link' => $socialDTO->getLink(),
        ]);
    }
    public function destroy(int $id)
    {
        Social::destroy($id);
    }
}
