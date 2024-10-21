<?php
namespace Rahweb\CmsCore\Modules\Seo\Services;

use Rahweb\CmsCore\Modules\Seo\DTO\SeoDTO;
use Rahweb\CmsCore\Modules\Seo\Entities\SeoMeta;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class SeoService
{
    protected $model;

    public function __construct(SeoMeta $model)
    {
        $this->model = $model;
    }
    public function create(SeoDTO $seoDTO)
    {


        $data = [
            'seoable_id' => $seoDTO->getSeoableId(),
            'seoable_type' => $seoDTO->getSeoableType(),
            'title_seo' => $seoDTO->getTitleSeo(),
            'description_seo' => $seoDTO->getDescriptionSeo(),
            'noindex' => $seoDTO->getNoIndex(),
        ];
        $condition = [
            'seoable_id' => $seoDTO->getSeoableId(),
            'seoable_type' => $seoDTO->getSeoableType(),
        ];
        $seo = $this->model::updateOrInsert($condition,$data);

    }
    public function findStatic(){
        return $this->model::orderByDesc('id')->whereNotNull('url')->get();
    }
    public static function findUrlStatic($url){
        $seo_statics = SeoMeta::orderByDesc('id')->whereNotNull('url')->where('url','/'.$url)
            ->first(['title_seo','description_seo','noindex']);
        return $seo_statics;
    }
    public function update(int $id, SeoDTO $seoDTO): void
    {
        $seo = $this->model::findOrFail($id);
        $seo->update([
            'title_seo' => $seoDTO->getTitleSeo(),
            'description_seo' => $seoDTO->getDescriptionSeo(),
            'noindex' => $seoDTO->getNoIndex(),
        ]);
    }

}
