<?php

namespace Rahweb\CmsCore\Modules\Product\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Product\DTO\ProductDTO;
use Rahweb\CmsCore\Modules\Product\DTO\TimerDTO;
use Rahweb\CmsCore\Modules\Product\Entities\Image;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class ProductService
{
    public function create(ProductDTO $productDTO)
    {
        $product = Product::create([
            'title' => $productDTO->getTitle(),
            'url' => $productDTO->getUrl(),
            'description' => $productDTO->getDescription(),
            'brand_id' => $productDTO->getBrandId(),
            'active' => $productDTO->getActive(),
            'price' => $productDTO->getPrice(),
            'discounted_price' => $productDTO->getDiscountedPrice(),
            'final_price' => $productDTO->getFinalPrice(),
            'show_in_first_page' => $productDTO->isShowInFirstPage(),
            'stock' => $productDTO->getStock(),
        ]);

        $product->categories()->attach($productDTO->getCategories());
        $product->related()->attach($productDTO->getProducts());
        $product->tags()->attach($productDTO->getTags());
    }

    public function update(int $id, ProductDTO $productDTO)
    {
        $product = Product::findOrfail($id);
        $product->update([
            'title' => $productDTO->getTitle(),
            'url' => $productDTO->getUrl(),
            'description' => $productDTO->getDescription(),
            'brand_id' => $productDTO->getBrandId(),
            'active' => $productDTO->getActive(),
            'price' => $productDTO->getPrice(),
            'discounted_price' => $productDTO->getDiscountedPrice(),
            'final_price' => $productDTO->getFinalPrice(),
            'show_in_first_page' => $productDTO->isShowInFirstPage(),
            'stock' => $productDTO->getStock(),
        ]);

        $product->categories()->sync($productDTO->getCategories());
        $product->related()->sync($productDTO->getProducts());
        $product->tags()->sync($productDTO->getTags());
    }

    public function timer(TimerDTO $timerDTO)
    {
        if ($timerDTO->getStartTimer() > $timerDTO->getTimerDate()) {
            return \redirect()->back()->with('error', 'تاریخ آغاز نباید از تاریخ پایان بزرگتر باشد');
        }

        $product = Product::findOrFail($timerDTO->getProductId());
        $product->update([
            'end_timer' => $timerDTO->getTimerDate(),
            'start_timer' => $timerDTO->getStartTimer(),
            'timer_active' => $timerDTO->getTimerActive(),
        ]);
    }

    public function destroy(int $id)
    {

        Product::destroy($id);
    }

    public static function findAll($query = [], $except_id = null, $limit = null)
    {
        $products = Product::query();
        if ($except_id) {
            $products->where('id', '<>', $except_id);
        }
        if (isset($query['brand'])) {
            $products->where('brand_id', $query['brand']);
        }
        if (isset($query['category'])) {
            $products->whereHas('categories', function ($query2) use ($query) {
                $query2->where("product_category_id", $query['specific_id']);
            });
        }
        if (isset($query['categories'])) {
            $products->whereHas('categories', function ($query2) use ($query) {
                $query2->whereIn("product_category_id", $query['categories']);
            });
        }
        if (isset($query['first_page'])) {
            $products->firstPage();
        }
        if (isset($query['timer'])) {
            $current_time = Carbon::now()->timezone('Asia/Tehran');

            $products->where(function ($query) use ($current_time) {
                $query->whereNotNull('discounted_price')
                    ->orWhere('discounted_price', '<>', 0);
            })->where('timer_active', '1')
                ->where('start_timer', '<', $current_time)
                ->where('end_timer', '>', $current_time);
        }

        if (isset($query['related'])) {
            $products->whereHas('related', function ($query2) use ($query) {
                $query2->whereIn("related_product_id", $query['related']);
            });
        }
        if (isset($query['paginate']))
        {
            return $products->orderby('id', 'DESC');
        }
        if ($limit != null) {
            return $products->orderby('id', 'DESC')->take($limit)->get();
        } else {
            return $products->orderby('id', 'DESC')->get();
        }


    }

    public static function findOne($url)
    {
        return Product::where('url', $url)->firstOrFail();
    }

    public static function getProductImagesSizeSeperated($images){
        $images_format = [];
        foreach($images as $image){
            $images_format[] =  [
                'id' => $image->id,
                'image_big' => $image->getImage('big'),
                'image_small' => $image->getImage('small'),
                'image_medium' => $image->getImage('medium'),
            ];
        }
        return $images_format;
    }

    public function findInFirstPage($paginate = 12)
    {
        return Product::firstPage()->take($paginate)->get();
    }
}
