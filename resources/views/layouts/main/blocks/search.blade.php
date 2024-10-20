{{-- search modal --}}

<div class="offcanvas offcanvas-top border-0 search-canvas" tabindex="-1" id="searchCanvas" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <button type="button" class="shadow-none btn bg-transparent border-0 shadow-none" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-x-lg fs-1 d-flex text-white"></i>
        </button>
    </div>
    <div class="offcanvas-body d-flex justify-content-center align-items-start">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-7 col-sm-8 col-12 p-0 mt-4 mx-auto">

            <form method="GET" action="{{route('search.detail')}}" class="position-relative" id="search-vue">
                <input type="hidden" name="search_form" value="1">
                <input type="text" name="search" id="input" @input="searchResult" v-model="searchInput" autocomplete="off" class="form-control py-2 font-th " placeholder="لطفا کلمه یا متن موردنظر را وارد کنید...">
                <button type="submit" class="btn border-0 bg-transparent shadow-none position-absolute top-0 bottom-0 end-0">
                    <i class="bi bi-search d-flex fs-5"></i>
                </button>
                <div v-if="searchInput.length > 1">
                    <div class="suggust-search" v-if="noResults == false">
                        <div class="p-0 m-0" v-if="searchLoading == true">
                            <div class="d-flex align-items-center justify-content-center py-3">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="row w-100 m-0" v-else>
                            <div class="col-12 p-1 mb-2" v-if="searchedProducts.length > 0">
                                <p class=" color-title px-2 font-th op-light mb-1 small d-flex align-items-center">
                                    <i class="bi bi-dash d-flex font-small me-1"></i>
                                    محصولات
                                </p>
                                <ul class="px-0 mx-0 mt-0 mb-0 d-flex w-100 suggest-ul-pro">
                                    <li class="py-1 suggest-items-pro" v-for="searchedProduct in searchedProducts">
                                        <a :href="searchedProduct.url" class="text-secondary suggest-link">
                                            <img :src="searchedProduct.image" :alt="searchedProduct.title" class="suggest-link-img w-100">
                                            <div class="mt-2 suggest-link-name mb-1 px-1" v-html="colorResult(searchedProduct.title)">

                                            </div>
                                        </a>

                                    </li>

                                </ul>
                            </div>

                            <div class="col-xl-4 p-1 mb-2" v-if="searchedBrands.length > 0">
                                <ul class="p-0 m-0">
                                    <div class="section">
                                        <p class=" color-title px-2 font-th op-light mb-0 small d-flex align-items-center">
                                            <i class="bi bi-dash d-flex font-small me-1"></i>
                                            برندها
                                        </p>
                                        <li v-for="searchedBrand in searchedBrands">
                                            <a :href="searchedBrand.url" class="d-flex align-items-center d-flex align-items-center idot" v-html="colorResult(searchedBrand.title)">
                                            </a>
                                        </li>

                                    </div>
                                </ul>
                            </div>
                            <div class="col-xl-4 p-1 mb-2" v-if="searchedProductCategories.length > 0">
                                <ul class="p-0 m-0">
                                    <div class="section">
                                        <p class=" color-title px-2 font-th op-light mb-0 small d-flex align-items-center">
                                            <i class="bi bi-dash d-flex font-small me-1"></i>
                                            دسته بندی ها
                                        </p>
                                        <li v-for="searchedCategory in searchedProductCategories">
                                            <a :href="searchedCategory.url" class="d-flex align-items-center d-flex align-items-center idot" v-html="colorResult(searchedCategory.title)">
                                            </a>
                                        </li>

                                    </div>
                                </ul>
                            </div>
                            <div class="col-xl-4 p-1 mb-2" v-if="searchedBlogs.length > 0">
                                <ul class="p-0 m-0">
                                    <div class="section">
                                        <p class=" color-title px-2 font-th op-light mb-0 small d-flex align-items-center">
                                            <i class="bi bi-dash d-flex font-small me-1"></i>
                                            بلاگ ها
                                        </p>
                                        <li v-for="searchedBlog in searchedBlogs">
                                            <a :href="searchedBlog.url" class="d-flex align-items-center d-flex align-items-center idot" v-html="colorResult(searchedBlog.title)">
                                            </a>
                                        </li>

                                    </div>
                                </ul>
                            </div>
                            <div class="col-xl-4 p-1 mb-2" v-if="searchedServices.length > 0">
                                <ul class="p-0 m-0">
                                    <div class="section">
                                        <p class=" color-title px-2 font-th op-light mb-0 small d-flex align-items-center">
                                            <i class="bi bi-dash d-flex font-small me-1"></i>
                                            خدمات
                                        </p>
                                        <li v-for="searchedService in searchedServices">
                                            <a :href="searchedService.url" class="d-flex align-items-center d-flex align-items-center idot " v-html="colorResult(searchedService.title)">
                                            </a>
                                        </li>

                                    </div>
                                </ul>
                            </div>
                            <div class="col-xl-4 p-1 mb-2" v-if="searchedPortfolios.length > 0">
                                <ul class="p-0 m-0">
                                    <div class="section">
                                        <p class=" color-title px-2 font-th op-light mb-0 small d-flex align-items-center">
                                            <i class="bi bi-dash d-flex font-small me-1"></i>
                                            نمونه کار ها
                                        </p>
                                        <li v-for="searchedPortfolio in searchedPortfolios">
                                            <a :href="searchedPortfolio.url" class="d-flex align-items-center d-flex align-items-center idot" v-html="colorResult(searchedPortfolio.title)">

                                            </a>
                                        </li>

                                    </div>
                                </ul>
                            </div>

                            <button type="submit" class="btn text-center mt-2 color-title font-th">
                                مشاهده همه
                            </button>
                        </div>
                    </div>
                    <div class="suggust-search" v-if="noResults == true && searchInput.length > 0">
                        <ul class="p-0 m-0">
                            <li class="">
                                <a href="#" class="d-flex align-items-center d-flex align-items-center">
                                    <i class="bi bi-dot d-flex"></i>
                                    موردی یافت نشد
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
