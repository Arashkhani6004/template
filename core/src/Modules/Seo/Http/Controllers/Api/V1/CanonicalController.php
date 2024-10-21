<?php

namespace Rahweb\CmsCore\Modules\Seo\Http\Controllers\Api\V1;

use Rahweb\CmsCore\Modules\Seo\DTO\SeoDTO;
use Rahweb\CmsCore\Modules\Seo\Entities\SeoMeta;
use Rahweb\CmsCore\Modules\Seo\Http\Requests\SeoRequest;
use Rahweb\CmsCore\Modules\Seo\Http\Requests\StaticSeoRequest;
use Rahweb\CmsCore\Modules\Seo\Services\CanonicalService;
use Rahweb\CmsCore\Modules\Seo\Services\RedirectService;
use Rahweb\CmsCore\Modules\Seo\Services\SeoService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CanonicalController extends Controller
{
    public function __construct(

        CanonicalService  $canonicalService,
    )
    {
        $this->canonicalService = $canonicalService;
    }
    public function index()
    {
        $canonicals = $this->canonicalService->findAll();
        return response()->json([
            'data' => compact(
                'canonicals'
            ),
            'success' => true,
        ]);
    }

}
