<?php

namespace Rahweb\CmsCore\Modules\General\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;

class PanelPermission
{
    public function __construct(Guard $auth){
        $this->auth = $auth;
    }
    public function handle($request,Closure $next){
        if(!$this->auth->check()){
   return redirect('/panel/login?url='.$request->path());
   }
        return $next($request);
    }
}
