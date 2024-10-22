<?php

namespace Rahweb\CmsCore\Modules\Order\DTO;

use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\Order\Http\Requests\DiscountRequest;
use Rahweb\CmsCore\Modules\Order\Http\Requests\OrderShippingStatusRequest;
use Rahweb\CmsCore\Modules\Order\Http\Requests\ShippingMethodRequest;


class DiscountDTO
{
    protected string $title;
    public function getTitle(): string
    {
        return $this->title;
    }
    protected string $max_usage_per_user;
  public function getMaxUsagePerUser(): string
    {
        return $this->max_usage_per_user;
    }
    protected string $basket_minimum_price;
    public function getBasketMinimumPrice(): string
    {
        return $this->basket_minimum_price;
    }

    protected string $type;
    public function getType() :string
    {
        return $this->type;
    }
    protected string $count;
    public function getCount(): string
    {
        return $this->count;
    }
    protected string $amount;
    public function getAmount(): string
    {
        return $this->amount;
    }

    public bool $first_purchase;
    public function getFirstPurchase(): bool
    {
        return $this->first_purchase;
    }
    public bool $with_discount;
    public function getWithDiscount(): bool
    {
        return $this->with_discount;
    }
    protected int|null $user_id;
    public function getUserId(): ?int
    {
        return $this->user_id;
    }
    public static function fromRequest(DiscountRequest $request)
    {

        $self = new self();
        $self->title = $request->get('title');
        $self->max_usage_per_user = intval(NumberHelper::persian2LatinDigit($request->get('max_usage_per_user')));
        $self->basket_minimum_price = intval(NumberHelper::persian2LatinDigit($request->get('basket_minimum_price')));
        $self->count = intval(NumberHelper::persian2LatinDigit($request->get('count')));
        $self->amount = intval(NumberHelper::persian2LatinDigit($request->get('amount')));
        $self->type = $request->get('type');
        $self->user_id = $request->get('user_id');
        $self->first_purchase = $request->has('first_purchase');
        $self->with_discount = $request->has('with_discount');



        return $self;
    }
}
