<?php

namespace Rahweb\CmsCore\Modules\Location\Services;

use Illuminate\Support\Facades\Auth;
use Rahweb\CmsCore\Modules\Location\Entities\Address;
use Rahweb\CmsCore\Modules\Location\Entities\State;
use Rahweb\CmsCore\Modules\Order\Entities\Basket;
use Rahweb\CmsCore\Modules\Order\Entities\BasketItem;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Product\Entities\ProductVariant;


class StateService
{

    public static function findAll()
    {
      return State::orderBy('name', 'ASC')->get();
    }

}
