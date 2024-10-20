     <!-- menu app -->
     <div class="menu-app d-lg-none d-block">
         <div class="row w-100 m-0">
             <div class="col-4 p-1 align-self-center">
                 <a href="{{route('basket.cart')}}" class="text-center d-flex flex-column align-items-center small font-re">
                     <i class="bi bi-bag fs-4 mb-1 color-title d-flex"></i>
                     سبد خرید
                 </a>
             </div>
             <div class="col-4 p-1 align-self-center">
                 <a href="{{route('index')}}" class="text-center d-flex flex-column align-items-center small font-re">
                     <i class="bi bi-house-door fs-4 mb-1 color-title d-flex"></i>
                     خانه
                 </a>
             </div>
             <div class="col-4 p-1 align-self-center">
                 <a href="{{route('panel.dashboard')}}" class="text-center d-flex flex-column align-items-center small font-re">
                     <i class="bi bi-person fs-4 mb-1 color-title d-flex"></i>
                 @auth {{Auth::user()->full_name}} @else ورود @endauth
                 </a>
             </div>
         </div>
     </div>
