<?php

namespace Rahweb\CmsCore\Modules\Product\Http\Controllers;


use Rahweb\CmsCore\Modules\Faq\Entities\Faq;
use Rahweb\CmsCore\Modules\Tag\Entities\Tag;
use Rahweb\CmsCore\Modules\Product\DTO\ImageDTO;
use Rahweb\CmsCore\Modules\Product\DTO\SpfDTO;
use Rahweb\CmsCore\Modules\Product\DTO\VideoFaqDTO;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Product\Entities\Property;
use Rahweb\CmsCore\Modules\Product\Entities\Video;
use Rahweb\CmsCore\Modules\Product\Http\Requests\ImageRequest;
use Rahweb\CmsCore\Modules\Product\Http\Requests\SpfRequest;
use Rahweb\CmsCore\Modules\Product\Http\Requests\VideoFaqRequest;
use Rahweb\CmsCore\Modules\Product\Services\ImageService;
use Rahweb\CmsCore\Modules\Product\Services\SpfService;
use Rahweb\CmsCore\Modules\Product\Services\VideoFaqService;
use Rahweb\CmsCore\Modules\Product\Entities\Specification;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class ImageController extends Controller
{
    protected $imageService;
    public function __construct(
        ImageService $imageService,
    )
    {
        $this->imageService = $imageService;
    }

    /**
     * /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {
        $data = Product::findOrFail($id);
        $specifications = Specification::whereHas('variants', function ($query) use ($data) {
            $query->where('product_id', $data->id);
        })->get();

        return view('CmsCore::product.product.image.create', compact('data','specifications'));

    }


    public function store(ImageRequest $request)
    {
        $this->imageService->create(ImageDTO::fromRequest($request));
        return redirect()->back()
            ->with('success', 'آیتم های جدید اضافه شد.');
    }
}
