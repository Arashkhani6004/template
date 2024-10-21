<?php

namespace Rahweb\CmsCore\Modules\Seo\DTO;

use Rahweb\CmsCore\Modules\Seo\Http\Requests\SeoRequest;
use Rahweb\CmsCore\Modules\Seo\Http\Requests\StaticSeoRequest;

class SeoDTO
{
    protected string|null $title_seo = null;
    public function getTitleSeo(): string|null
    {
        return $this->title_seo;
    }
    protected string|null $description_seo = null;
    public function getDescriptionSeo(): string|null
    {
        return $this->description_seo;
    }
    protected int|null $seoable_id;
    public function getSeoableId(): int|null
    {

        return $this->seoable_id;
    }
    protected string|null $seoable_type = null;
    public function getSeoableType(): string|null
    {
        return $this->seoable_type;
    }
    protected int|null $noindex;
    public function getNoIndex(): int|null
    {

        return $this->noindex;
    }
    public static function fromRequest(SeoRequest $request)
    {
        $self = new self();
        $self->seoable_id = $request->get('seoable_id');
        $self->seoable_type = $request->get('seoable_type');
        $self->title_seo = trim($request->get('seoTitle'));
        $self->description_seo = trim($request->get('seoDescription'));
        $self->noindex = @$request->has('seoIndex') ? 1 : 0;
        return $self;
    }
    public static function fromStaticRequest(StaticSeoRequest $request)
    {
        $self = new self();
        $self->title_seo = trim($request->get('title_seo'));
        $self->description_seo = trim($request->get('description_seo'));
        $self->noindex = @$request->has('noindex') ? 1 : 0;
        return $self;
    }
}
