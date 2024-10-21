<?php

namespace Rahweb\CmsCore\Modules\Product\Http\Controllers;


use Rahweb\CmsCore\Modules\Product\DTO\MainVariantDTO;
use Rahweb\CmsCore\Modules\Product\DTO\VariantDTO;
use Rahweb\CmsCore\Modules\Product\Entities\ProductVariant;
use Rahweb\CmsCore\Modules\Product\Http\Requests\MainVariantRequest;
use Rahweb\CmsCore\Modules\Product\Http\Requests\VariantRequest;
use Rahweb\CmsCore\Modules\Product\Services\VariantService;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Product\Services\SpfService;
use Rahweb\CmsCore\Modules\Product\Entities\Specification;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class VariantController extends Controller
{
    protected $videoFaqService;
    protected $spfService;
    public function __construct(
        SpfService $spfService,
        VariantService $variantService,
    )
    {
        $this->spfService = $spfService;
        $this->variantService = $variantService;

    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index($id)
    {
        $product = Product::findOrFail($id);
        $specifications = Specification::with(['children','product_values'])
            ->orderByDesc('id')
            ->whereNull('parent_id')
            ->doesntHave('categories')
            ->get();

        $sortedSpecifications = $specifications->sortBy(function ($specification) {
            return $specification->type == 'select' ? 0 : 1;
        });

        $sortedSpecifications = $sortedSpecifications->values()->all();


        return view('CmsCore::product.product.variant.create',
            compact('product','sortedSpecifications'));

    }
    public function storeMain(MainVariantRequest $request)
    {

        $this->variantService->createMain(MainVariantDTO::fromRequest($request));
        return redirect()->back()
            ->with('success', 'آیتم های جدید اضافه شد.');
    }
    public function store(VariantRequest $request)
    {
        $this->variantService->create(VariantDTO::fromRequest($request));
        if (VariantDTO::fromRequest($request)->getHasError() === true) {
            return redirect()->back()
                ->with('info', 'مقدار قیمت با تخفیف نرخ نباید از مقدار قیمت بالاتر باشد یا یکی از موارد مقدار ندارد(مقادیر معتبر اضافه شدند)');


        } else {
            return redirect()->back()
                ->with('success', 'آیتم های جدید اضافه شد.');

        }

    }
    public function destroy($id)
    {
        $this->variantService->delete($id);
        return response()->json(['success' => 'آیتم مورد نظر با موفقیت حذف شد.'], 200);

    }
    public function variants(Request $request)
    {
        $variants = ProductVariant::orderByDesc('id')->whereProductId($request->get('product_id'))->get();
        return response()->json(["variants" => $variants]);
    }


}
