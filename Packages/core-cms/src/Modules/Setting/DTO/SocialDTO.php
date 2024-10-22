<?php

namespace Rahweb\CmsCore\Modules\Setting\DTO;

use Rahweb\CmsCore\Modules\Setting\Http\Requests\SocialRequest;

class SocialDTO
{
    protected string $icon;
    public function getIcon(): string
    {
        return $this->icon;
    }
    protected string $link;
    public function getLink(): string
    {
        return $this->link;
    }
    public static function fromRequest(SocialRequest $request)
    {
        $self = new self();
        $self->icon = $request->get('icon');
        $self->link = $request->get('link');
        return $self;
    }
}
