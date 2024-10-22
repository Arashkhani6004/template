<?php

namespace Rahweb\CmsCore\Modules\Seo\DTO;

use Rahweb\CmsCore\Modules\Seo\Http\Requests\RedirectRequest;

class RedirectDTO
{
    protected string|null $old_address;

    public function getOldAddress(): string
    {
        return $this->old_address;
    }

    protected string|null $new_address;

    public function getNewAddress(): string
    {
        return $this->new_address;
    }

    public static function fromRequest(RedirectRequest $request)
    {

        $self = new self();
        $self->old_address = trim(str_replace(url('/'), "", $request->get('old_address')), '/');
        $self->new_address = str_replace(url('/'), "", $request->get('new_address'));
        if ($self->new_address != "/") {
            $self->new_address = trim(str_replace(url('/'), "", $request->get('new_address')), '/');
        }
        return $self;
    }

}
