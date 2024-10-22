<?php
namespace Rahweb\CmsCore\Modules\Product\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Helper\FileUploader;
use Rahweb\CmsCore\Modules\General\Helper\MakeTree;
use Rahweb\CmsCore\Modules\Product\DTO\ProductCategoryDTO;
use Rahweb\CmsCore\Modules\Product\Entities\ProductCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class ProductCategoryService
{
    public function create(ProductCategoryDTO $productCategoryDTO)
    {
        $image = null;
        if ($productCategoryDTO->getImage()) {
            $uploader = new FileUploader($productCategoryDTO->getImage(), "uploads/product-category");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [300, 300],"medium" => [150, 150]]);
            $image = $uploader->upload();
        }
        ProductCategory::create([
            'title' => $productCategoryDTO->getTitle(),
            'description' => $productCategoryDTO->getDescription(),
            'url' => $productCategoryDTO->getUrl(),
            'parent_id' => $productCategoryDTO->getParentId(),
            'image' => $image,
            'active' => $productCategoryDTO->getActive(),
            'show_in_first_page' => $productCategoryDTO->isShowInFirstPage(),
        ]);

    }
    public function update(int $id, ProductCategoryDTO $productCategoryDTO)
    {
        $category = ProductCategory::findOrfail($id);
        $image = $category->getRawOriginal('image');
        if ($productCategoryDTO->getImage()) {
            $uploader = new FileUploader($productCategoryDTO->getImage(), "uploads/product-category");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [300, 300],"medium" => [150, 150]]);
            $image = $uploader->upload();
        }
        $category->update([
            'title' => $productCategoryDTO->getTitle(),
            'description' => $productCategoryDTO->getDescription(),
            'url' => $productCategoryDTO->getUrl(),
            'parent_id' => $productCategoryDTO->getParentId(),
            'image' => $image,
            'active' => $productCategoryDTO->getActive(),
            'show_in_first_page' => $productCategoryDTO->isShowInFirstPage(),
        ]);

    }
    public function getProductCategoryIdsRecursive($productCategory, &$productCategories, $addToProductCategories = true)
    {
        if ($addToProductCategories) {
            $productCategories[] = $productCategory->id;
        }
        if ($productCategory->children->isNotEmpty()) {
            foreach ($productCategory->children as $child) {
                $this->getProductCategoryIdsRecursive($child, $productCategories);
            }
        }
    }

    public function deleteOne(int $id): void
    {
        $productCategory = ProductCategory::findOrFail($id);

        //delete image
        if ($productCategory->image) {
            FileManager::delete("product-category/" . $productCategory->getRawOriginal('image'));
        }

        //update children
        $productCategories = [];
        $this->getProductCategoryIdsRecursive($productCategory, $productCategories, false);
        $changes = ProductCategory::whereIn('id', $productCategories)->get();
        foreach ($changes as $change) {
            $change->update([
                'parent_id' => null,
            ]);
        }

        //delete itself
        $productCategory->delete();
    }

    public function deleteRoot(int $id)
    {
        $productCategory = ProductCategory::findOrFail($id);

        //delete image
        if ($productCategory->image) {
            FileManager::delete("product-category/" . $productCategory->getRawOriginal('image'));
        }

        //delete children
        $productCategories = [];
        $this->getProductCategoryIdsRecursive($productCategory, $productCategories, false);
        $children = ProductCategory::whereIn('id', $productCategories)->get();
        foreach ($children as $child) {
            if ($child->image) {
                FileManager::delete("product-category/" . $child->getRawOriginal('image'));
            }
            $child->delete();
        }

        //delete itself
        $productCategory->delete();
    }
    //
    public static function findAll($query = [], $format = true, $except_id = null, $limit = null)
    {
        $product_categories = ProductCategory::query();
        if ($except_id) {
            $product_categories->where('id', '<>', $except_id);
        }
        if (isset($query['first_page'])) {
            $product_categories->firstPage();
        }
        if (isset($query['layout'])) {
            $product_categories->where('active',1);
        }
        if (isset($query['list'])) {
            $product_categories->whereNull('parent_id');
        }
        if (isset($query['related'])) {
            $product_categories->where('parent_id',$query['parent_id']);
        }
        if (isset($query['filter_categories'])) {
            $product_categories->whereIn('id',$query['filter_categories']);
        }



        if ($limit != null) {
            $products = $product_categories->orderby('id', 'DESC')->take($limit)->get();
        }
        else{
            $products = $product_categories->orderby('id', 'DESC')->get();

        }
        if ($format) {
            return self::formatProductCategories($products);
        } else {
            return $products;
        }

    }
    public static function findOne($url)
    {
        return ProductCategory::where('url',$url)->firstOrFail();
    }

    public static function formatProductCategories($product_categories, $paginate = 5000)
    {
        if (!empty($product_categories) && count($product_categories) > 0) {
            MakeTree::getData($product_categories);
            $product_categories = MakeTree::GenerateArray(array('paginate' => $paginate));
        }
        return $product_categories;
    }

}
