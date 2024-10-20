<?php

namespace App\Http\Middleware;

use App\Library\SiteHelper;
use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ValidateSassGateway
{
    public function handle($request, Closure $next)
    {
        SiteHelper::setSiteInformation();
        return $next($request);
    }
}
