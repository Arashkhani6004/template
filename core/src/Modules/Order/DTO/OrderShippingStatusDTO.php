<?php

namespace Rahweb\CmsCore\Modules\Order\DTO;

use Rahweb\CmsCore\Modules\Order\Http\Requests\OrderShippingStatusRequest;


class OrderShippingStatusDTO
{
    protected string $title;
    public function getTitle(): string
    {
        return $this->title;
    }

    protected string $color;
    public function getColor(): string
    {
        return $this->color;
    }

    public bool $default;
    public function getDefault(): bool
    {
        return $this->default;
    }
    public static function fromRequest(OrderShippingStatusRequest $request)
    {

        $self = new self();
        $self->title = $request->get('title');
        $self->color = $request->get('color');
        $self->image = $request->file('image');
        $self->default = $request->has('default');
        return $self;
    }
}
