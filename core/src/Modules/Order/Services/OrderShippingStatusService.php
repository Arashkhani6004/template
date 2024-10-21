<?php
namespace Rahweb\CmsCore\Modules\Order\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Order\DTO\OrderShippingStatusDTO;
use Rahweb\CmsCore\Modules\Order\Entities\OrderShippingStatus;

class OrderShippingStatusService
{
    public function create(OrderShippingStatusDTO $orderShippingStatusDTO)
    {
        if ($orderShippingStatusDTO->getDefault() == 1){
            OrderShippingStatus::orderBy('id','DESC')->update([
               'default' => 0
            ]);
        }
        $status = OrderShippingStatus::create([
            'title' => $orderShippingStatusDTO->getTitle(),
            'color' => $orderShippingStatusDTO->getColor(),
            'default' => $orderShippingStatusDTO->getDefault(),
        ]);

    }
    public function update(int $id, OrderShippingStatusDTO $orderShippingStatusDTO)
    {
        $status = OrderShippingStatus::findOrfail($id);
        if ($orderShippingStatusDTO->getDefault() == 1){
            OrderShippingStatus::orderBy('id','DESC')->where('id','<>',$id)->update([
                'default' => 0
            ]);
        }
        $status->update([
            'title' => $orderShippingStatusDTO->getTitle(),
            'color' => $orderShippingStatusDTO->getColor(),
            'default' => $orderShippingStatusDTO->getDefault(),
        ]);

    }

    public function deleteOne(int $id): void
    {
        $status = OrderShippingStatus::findOrFail($id);

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
