<?php
namespace Rahweb\CmsCore\Modules\Setting\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Setting\DTO\SloganDTO;
use Rahweb\CmsCore\Modules\Setting\Entities\Slogan;


class SloganService
{
    public function create(SloganDTO $sloganDTO)
    {
        $image = $sloganDTO->getIcon() ? FileManager::upload($sloganDTO->getIcon(),"setting") : null;
        Slogan::create([
            'value' => $sloganDTO->getValue(),
            'active' => $sloganDTO->getActive(),
            'icon' => $image,
        ]);

    }
    public function update(int $id, SloganDTO $sloganDTO)
    {
        $gallery = Slogan::findOrfail($id);
        $image = $sloganDTO->getIcon() ? FileManager::upload($sloganDTO->getIcon(),"setting") : $gallery->getRawOriginal('icon');
        $gallery->update([
            'value' => $sloganDTO->getValue(),
            'active' => $sloganDTO->getActive(),
            'icon' => $image,
        ]);
    }
    public function destroy(int $id)
    {
        Slogan::destroy($id);
    }

    public static function findAll($query =[], $limit = null)
    {
        $data = Slogan::query();
        if (isset($query['first_page'])) {
            $data->firstPage();
        }
        return $data->take($limit)->get();
    }
}
