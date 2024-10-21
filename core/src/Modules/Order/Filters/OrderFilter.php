<?php

namespace Rahweb\CmsCore\Modules\Order\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrderFilter
{
    public function apply(Builder $query, $filters)
    {
        if (isset($filters['full_name'])) {
            $query->whereHas('user', function (Builder $query2) use ($filters) {
                $query2->where('full_name', 'LIKE', '%' . $filters['full_name'] . '%');
            });

        }
        if (isset($filters['mobile'])) {
            $query->whereHas('user', function (Builder $query2) use ($filters) {
                $query2->where('mobile', 'LIKE', '%' . $filters['mobile'] . '%');
            });

        }
        if (isset($filters['id'])) {
            $query->where('id', $filters['id']);
        }
        if (isset($filters['shipping_method_id'])) {
            $query->where('shipping_method_id', $filters['shipping_method_id']);
        }
        if (isset($filters['shipping_status_id'])) {
            $query->where('shipping_status_id', $filters['shipping_status_id']);
        }
        if (isset($filters['order_status'])) {
            $query->where('order_status', $filters['order_status']);
        }
        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        return $query;
    }
}
