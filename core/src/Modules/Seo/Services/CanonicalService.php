<?php
namespace Rahweb\CmsCore\Modules\Seo\Services;

use Rahweb\CmsCore\Modules\Seo\DTO\CanonicalDTO;
use Rahweb\CmsCore\Modules\Seo\Entities\Canonical;
class CanonicalService
{
    public function create(CanonicalDTO $canonicalDTO)
    {
        Canonical::create([
        'url'=>$canonicalDTO->getUrl(),
        'canonical'=>$canonicalDTO->getCanonical(),
        ]);

    }
    public function update(int $id, CanonicalDTO $canonicalDTO)
    {
        $canonical = Canonical::findOrfail($id);
        $canonical->update([
            'url'=>$canonicalDTO->getUrl(),
            'canonical'=>$canonicalDTO->getCanonical(),
        ]);

    }



    public function destroy(int $id)
    {
        Canonical::destroy($id);
    }

    public static function findAll()
    {
        return Canonical::orderBy('id', 'DESC')->get();
    }
}
