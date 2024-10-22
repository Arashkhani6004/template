<?php

namespace Rahweb\CmsCore\Modules\Seo\Http\Controllers\Api\V1;

use Rahweb\CmsCore\Modules\Seo\DTO\SeoDTO;
use Rahweb\CmsCore\Modules\Seo\Entities\SeoMeta;
use Rahweb\CmsCore\Modules\Seo\Http\Requests\SeoRequest;
use Rahweb\CmsCore\Modules\Seo\Http\Requests\StaticSeoRequest;
use Rahweb\CmsCore\Modules\Seo\Services\RedirectService;
use Rahweb\CmsCore\Modules\Seo\Services\SeoService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RedirectController extends Controller
{
    public function __construct(

        RedirectService  $redirectService,
    )
    {
        $this->redirectService = $redirectService;
    }
    public function index()
    {
        $redirects = $this->redirectService->findAll();
        return response()->json([
            'data' => compact(
                'redirects'
            ),
            'success' => true,
        ]);
    }

}
