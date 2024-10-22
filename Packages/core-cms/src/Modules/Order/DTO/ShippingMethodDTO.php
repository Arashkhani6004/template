<?php

namespace Rahweb\CmsCore\Modules\Order\DTO;

use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\Order\Http\Requests\OrderShippingStatusRequest;
use Rahweb\CmsCore\Modules\Order\Http\Requests\ShippingMethodRequest;


class ShippingMethodDTO
{
    protected string $title;
    public function getTitle(): string
    {
        return $this->title;
    }

    protected  $price;
    public function getPrice()
    {
        return $this->price;
    }

    public bool $status;
    public function getStatus(): bool
    {
        return $this->status;
    }
    protected array $cities = [];

    public function getCities(): array
    {
        return $this->cities;
    }
    public static function fromRequest(ShippingMethodRequest $request)
    {

        $self = new self();
        $self->title = $request->get('title');
        $self->price = intval(NumberHelper::persian2LatinDigit($request->get('price')));
        $self->status = $request->has('status');
        if ($request->get('cities')) $self->cities = $request->get('cities');

        return $self;
    }
}
