<?php
namespace Rahweb\CmsCore\Modules\Order\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Order\DTO\OrderShippingStatusDTO;
use Rahweb\CmsCore\Modules\Order\DTO\ShippingMethodDTO;
use Rahweb\CmsCore\Modules\Order\Entities\OrderShippingStatus;
use Rahweb\CmsCore\Modules\Order\Entities\ShippingMethod;

class ShippingMethodService
{
    public function create(ShippingMethodDTO $shippingMethodDTO)
    {

        $method = ShippingMethod::create([
            'title' => $shippingMethodDTO->getTitle(),
            'price' => $shippingMethodDTO->getPrice(),
            'status' => $shippingMethodDTO->getStatus(),
        ]);
        $method->cities()->attach($shippingMethodDTO->getCities());
    }
    public function update(int $id, ShippingMethodDTO $shippingMethodDTO)
    {
        $method = ShippingMethod::findOrfail($id);

        $method->update([
            'title' => $shippingMethodDTO->getTitle(),
            'price' => $shippingMethodDTO->getPrice(),
            'status' => $shippingMethodDTO->getStatus(),
        ]);
        $method->cities()->sync($shippingMethodDTO->getCities());
    }

    public function deleteOne(int $id): void
    {
        $status = ShippingMethod::findOrFail($id);

        $status->delete();
    }

    //
    public static function findAll($query = [], $except_id = null, $limit = null)
    {
        $statuses = OrderShippingStatus::query();
        if ($except_id) {
            $statuses->where('id', '<>', $except_id);
        }

        if (isset($query['title'])) {
            $statuses->where('title','LIKE','%'.$query['title'].'%');
        }
        if ($limit != null) {
            return $statuses->orderby('id', 'DESC')->take($limit)->get();
        }else{
            return $statuses->orderby('id', 'DESC')->get();
        }
    }



}
