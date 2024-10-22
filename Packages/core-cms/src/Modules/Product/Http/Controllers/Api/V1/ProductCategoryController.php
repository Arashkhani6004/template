<?php

namespace Rahweb\CmsCore\Modules\Product\Http\Controllers\Api\V1;


use Rahweb\CmsCore\Modules\Present\Package\Http\Resources\PackageCollection;
use Rahweb\CmsCore\Modules\Present\Package\Services\PackageService;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Product\Entities\ProductCategory;
use Rahweb\CmsCore\Modules\Product\Http\Resources\BrandCollection;
use Rahweb\CmsCore\Modules\Product\Http\Resources\ProductCategoryCollection;
use Rahweb\CmsCore\Modules\Product\Http\Resources\ProductCollection;
use Rahweb\CmsCore\Modules\Product\Http\Resources\SpecificationCollection;
use Rahweb\CmsCore\Modules\Product\Services\BrandService;
use Rahweb\CmsCore\Modules\Product\Services\ProductCategoryService;
use Rahweb\CmsCore\Modules\Product\Services\ProductService;
use Rahweb\CmsCore\Modules\Product\Entities\Specification;
use Rahweb\CmsCore\Modules\Product\Services\SpecificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductCategoryController

{
    public function __construct(
        ProductCategoryService $prodcutCategoryService,
        ProductService         $prodcutService,
        BrandService           $brandService,
        SpecificationService   $specificationService,
    )
    {
        $this->prodcutCategoryService = $prodcutCategoryService;
        $this->prodcutService = $prodcutService;
        $this->brandService = $brandService;
        $this->specificationService = $specificationService;
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function getList(): JsonResponse
    {
        $query_category = ['list' => true];
        $found_product_categories = $this->prodcutCategoryService->findAll($query_category, false);

        $prodcutCategoryCollection = new ProductCategoryCollection($found_product_categories);
        $prodcutCategoryCollection->setHiddenFields(['description']);

        $product_categories = $prodcutCategoryCollection->toArray(request());

        return response()->json([
            'data' => compact(
                'product_categories',
            ),
            'success' => true
        ]);
    }

    public function getProductList($url): JsonResponse
    {
        $found_category = $this->prodcutCategoryService->findOne($url);
        $categoryCollection = new ProductCategoryCollection($found_category);
        $product_category = $categoryCollection->transformItemToArray($found_category);
        //children
        $category_children = $found_category->children;
        $childrenCategoryCollection = new ProductCategoryCollection($category_children);
        $categoryCollection->setImageSize('medium');
        $childrenCategoryCollection->setHiddenFields(['description']);
        $children = $childrenCategoryCollection->toArray(request());
        //products
        $category_ids = [];
        $category_ids[] =
            $found_category['id'];
        foreach ($found_category->children as $row) {
            $category_ids[] = $row['id'];
            if (count($row->children) > 0) {
                foreach ($row->children as $child) {
                    $category_ids[] = $child['id'];
                }
            }
        }
        $query = ['categories' => $category_ids];
        $category_products = $this->prodcutService->findAll($query, null, 12);
        $product_price = $this->prodcutService->findAll($query);
        $productCollection = new ProductCollection($category_products);
        $productCollection->setHiddenFields(['description', 'vue_url']);
        $products = $productCollection->toArray(request());
        $min_price = collect($product_price)->min('final_price');
        $max_price = collect($product_price)->max('final_price');
        //brands
        $brand_ids = $this->prodcutService->findAll($query)->pluck('brand_id');
        $query_brand = ['filter_brands' => $brand_ids];
        $found_brands = $this->brandService->findAll($query_brand);
        $brandCollection = new BrandCollection($found_brands);
        $brandCollection->setHiddenFields(['description', 'image']);
        $brands = $brandCollection->toArray(request());
        //specifications
        $query_filter = ['categories' => $category_ids, 'is_filter' => true];
        $found_filter = $this->specificationService->findAll($query_filter);
        $filterCollection = new SpecificationCollection($found_filter);
        $filterCollection->setHiddenFields(['type']);
        $filters = $filterCollection->toArray(request());
        return response()->json([
            'data' => compact(
                'product_category',
                'children',
                'products',
                'brands',
                'filters',
                'max_price',
                'min_price'
            ),
            'success' => true
        ]);
    }


    public function getProductListVue(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $query = Product::query();
        if ($request->has('category_id')) {
            $category = ProductCategory::findOrFail($request->get('category_id'));
            if (count($category->children) > 0) {
                $category_ids = [];
                $category_ids[] = [
                    'cat_id' => $category['id']
                ];
                foreach ($category->children as $row) {
                    $category_ids[] = ['cat_id' => $row['id']];
                    if (count($row->children) > 0) {
                        foreach ($row->children as $child) {
                            $category_ids[] = $child['id'];

                        }
                    }
                }
                $query->whereHas('categories', function ($query2) use ($category_ids) {
                    $query2->whereIn("product_category_id", $category_ids);
                });

            } else {
                $query->whereHas('categories', function ($query2) use ($request) {

                    $query2->where("product_category_id", $request->get('category_id'));
                });
            }

            if ($request->get('brand_id') != []) {

                $query->whereIn('brand_id', $request->get('brand_id'));

            }
            if ($request->get('filter_id') != []) {
                $spfs = Specification::whereIn('id', $request->get('filter_id'))->get()->groupBy('parent_id');
                foreach ($spfs as $spf) {
                    $query->whereHas('specifications', function ($query2) use ($spf) {
                        $query2->whereIn("specification_id", $spf->pluck('id'));
                    });
                }


            }
            if ($request->get('product_title') != null) {
                $query->where('title', 'LIKE', '%' . $request->get('product_title') . '%');
            }
            if ($request->get('discounted_price') == 1) {
                $query->whereNotNull('discounted_price');
            }
            if ($request->get('price_range') != null) {
                $minPrice = floatval($request->get('min_price')); // تبدیل به عدد شناور برای حداقل قیمت
                $maxPrice = floatval($request->get('max_price')); // تبدیل به عدد شناور برای حداکثر قیمت

                $query->whereRaw('CAST(final_price AS DECIMAL(10, 2)) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
            }
            if ($request->get('sort_by') != null &&
                ($request->get('sort_by') == "cheapest" || $request->get('sort_by') == "expensive")) {
                if ($request->get('sort_by') == "expensive") {
                    $category_products = $query->orderByRaw('CAST(final_price AS UNSIGNED) DESC')->paginate(12, ['*'], 'page', $page);
                }
                if ($request->get('sort_by') == "cheapest") {
                    $category_products = $query->orderByRaw('CAST(final_price AS UNSIGNED) ASC')->paginate(12, ['*'], 'page', $page);
                }
            } else {
                $category_products = $query->orderByDesc('id')->paginate(12, ['*'], 'page', $page);
            }


            $productCollection = new ProductCollection($category_products);
            $productCollection->setHiddenFields(['description']);
            $products = $productCollection->toArray(request());
            $lastPage = $category_products->lastPage();
            $currentPage = $category_products->currentPage();

            return response()->json([
                'data' => compact(
                    'products',
                    'lastPage',
                    'currentPage',
                ),
                'success' => true
            ]);
        }

    }

}
