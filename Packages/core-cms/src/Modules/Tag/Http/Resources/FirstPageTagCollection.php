<?php

namespace Rahweb\CmsCore\Modules\Tag\Http\Resources;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Product\Http\Resources\ProductCollection;
use Rahweb\CmsCore\Modules\Setting\Entities\Setting;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FirstPageTagCollection extends ResourceCollection
{
    protected $hiddenFields = [];

    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return $this->transformItemToArray($item);
        })->toArray();
    }
//Todo : جابجایی unset
    public function transformItemToArray($item)
    {

        $data = [
            'id' => $item->id,
            'title' => $item->title,
            'url' => $item->url,
            'banner' => $item->item_first_page_image,
            'icon' => $item->item_first_page_icon,
            'products' => new ProductCollection($item->products),

        ];

        foreach ($this->hiddenFields as $field) {
            unset($data[$field]);
        }

        return $data;
    }

    public function setHiddenFields(array $fields)
    {
        $this->hiddenFields = $fields;
        return $this;
    }
}


