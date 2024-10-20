{{-- mega menu --}}
@if($menu_product_categories && count($menu_product_categories))
    <div class="offcanvas offcanvas-bottom bg-transparent border-0 mega-modal" tabindex="-1" id="megaModalCategory"
         aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-body d-flex justify-content-center align-items-center">
            <button type="button"
                    class="shadow-none btn bg-transparent border-0 shadow-none position-absolute top-0 start-0 m-4"
                    data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="bi bi-x-lg fs-1 d-flex text-white"></i>
            </button>
            <div class="col-xxl-8 col-xl-8 col-lg-10 col-md-7 col-sm-8 col-11 p-0 m-auto p-3 bg-white rounded-4">
                <div class="row w-100 m-0">
                    <div class="col-xxl-2 col-xl-3 col-lg-3 nav-side ps-0 pe-4">
                        <div class="nav flex-column nav-pills " id="v-pills-category-tab" role="tablist"
                             aria-orientation="vertical">
                            @foreach($menu_product_categories as $menu_product_category_key => $menu_product_category)
                                <button class="nav-link @if($menu_product_category_key == 0) active @endif"
                                        id="v-pills-category-{{$menu_product_category_key}}-tab"
                                        data-bs-toggle="pill"
                                        data-bs-target="#v-pills-category-{{$menu_product_category_key}}"
                                        type="button"
                                        role="tab" aria-controls="v-pills-category-{{$menu_product_category_key}}"
                                        aria-selected="{{$menu_product_category_key == 0 ? "true" : "false"}}"> {{$menu_product_category['title']}}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xxl-10 col-xl-9 col-lg-9 content-side p-0">
                        <div class="tab-content" id="v-pills-category-tabContent">
                            @foreach($menu_product_categories as $menu_product_category_key => $menu_product_category)
                                <div class="tab-pane fade  @if($menu_product_category_key == 0) show active @endif"
                                     id="v-pills-category-{{$menu_product_category_key}}" role="tabpanel"
                                     aria-labelledby="v-pills-category-{{$menu_product_category_key}}-tab" tabindex="0">
                                    <a href="{{ route('category.detail', ['url' => $menu_product_category['url']]) }}"
                                       class="color-title font-md small d-flex align-items-center">
                                        {{$menu_product_category['title']}}
                                        <i class="bi bi-arrow-left-short d-flex ms-1"></i>
                                    </a>
                                    <div class="row w-100 m-0 mt-2 pt-2 border-top sub-cat">
                                        @foreach($menu_product_category['children'] as $menu_product_category_children)
                                            <div class="col-xl-4 col-lg-4 p-2">
                                                <a href="{{ route('category.detail', ['url' => $menu_product_category_children['url']]) }}"
                                                   class="font-md small color-title d-flex align-items-center">
                                                    {{$menu_product_category_children['title']}}
                                                    <i class="bi bi-chevron-left d-flex ms-1"></i>
                                                </a>
                                                <ul class="p-0 m-0 mt-2 mb-4">
                                                    @foreach($menu_product_category_children['children'] as $menu_product_category_child)
                                                        <li class="list-unstyled">
                                                            <a href="{{ route('category.detail', ['url' => $menu_product_category_child['url']]) }}"
                                                               class="font-th color-title op-light small">
                                                                {{$menu_product_category_child['title']}}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
