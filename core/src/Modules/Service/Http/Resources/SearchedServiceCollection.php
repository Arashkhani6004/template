<?php

namespace Rahweb\CmsCore\Modules\Service\Http\Resources;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Setting\Entities\Setting;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SearchedServiceCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return $this->transformItemToArray($item);
        })->toArray();
    }
    public function transformItemToArray($item)
    {
        $data = [
            'id' => $item->id,
            'title' => $item->title,
            'url'=>'/service/'.$item->url ,

        ];


        return $data;
    }

}


