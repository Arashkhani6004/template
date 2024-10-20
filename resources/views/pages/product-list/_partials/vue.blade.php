<script src="https://unpkg.com/vuejs-paginate@0.9.0"></script>
<script>
    Vue.component('paginate', VuejsPaginate)
    Vue.directive('scroll', {
        inserted: function (el, binding) {
            let f = function (evt) {
                if (binding.value(evt, el)) {
                    window.removeEventListener('scroll', f)
                }
            }
            window.addEventListener('scroll', f)
        }
    });
    new Vue({
        el: '#app',
        data: {
            brands: @json($brands) ? @json($brands) : [],
            filters: @json($filters) ? @json($filters) : [],
            category_id: '{{$product_category['id']}}',
            selectedBrands: [],
            discountedPrice: [],
            selectedFilters: [],
            products: [],
            searchBrand: "",
            searchFilter: "",
            productTitle: "",
            page: 1,
            currentPage: 1,
            pageCount: 1,
            stopCall: false,
            isFilter: false,
            loading: false,
            filterLoading: false,
            titleLoading: false,
            scrollable: true,
            brand_id: "",
            filter_id: "",
            discounted_price: 0,
            sortBy: "",
            sort_by: "",
            priceRange : "",
            minPrice : "",
            maxPrice : "",
        },
        methods: {

            async handlePageClick(pageNumber) {
                    this.page = pageNumber;
                    this.deleteLaravel();
                    this.products =  [];
                    await this.getProductAxios();
            },
            async getProductAxios(val) {
                this.loading = true;

                if(val === "priceFilterDesktop"){
                    this.page = 1;
                    this.deleteLaravel();
                    this.priceRange = document.getElementById('min_price').value+'_'+document.getElementById('max_price').value;
                    this.minPrice = document.getElementById('min_price').value;
                    this.maxPrice = document.getElementById('max_price').value;
                    this.updateUrlParams();
                }
                if(val === "priceFilterMobile"){
                    this.page = 1;
                    this.deleteLaravel();
                    this.priceRange = document.getElementById('min_price_mobile').value+'_'+document.getElementById('max_price_mobile').value
                    this.minPrice = document.getElementById('min_price_mobile').value;
                    this.maxPrice = document.getElementById('max_price_mobile').value;
                    this.updateUrlParams();
                }
                // if(this.isFilter === true){
                //     this.products = [];
                // }
                if(this.priceRange){
                    const parts = this.priceRange.split('_');
                    this.minPrice = parseInt(parts[0], 10);
                    this.maxPrice = parseInt(parts[1], 10);
                    this.page = 1;
                }

                try {
                    const response = await axios.post('{{$core_url.'api/v1/product-cat-vue'}}', {
                        page: this.page,
                        category_id: this.category_id,
                        product_title: this.productTitle,
                        brand_id: this.brand_id,
                        filter_id: this.filter_id,
                        discounted_price: this.discounted_price,
                        sort_by: this.sort_by,
                        min_price: parseInt(this.minPrice),
                        max_price: parseInt(this.maxPrice),
                        price_range: this.priceRange,
                    });
                    this.products = response.data.data.products;
                    this.lastPage = response.data.data.lastPage;
                    this.pageCount = response.data.data.lastPage;
                    this.currentPage = response.data.data.currentPage;
                    this.stopCall = this.page >= response.data.data.lastPage;
                    this.loading = false;
                    this.titleLoading = false;

                } catch (error) {
                    console.error('Error fetching products:', error);
                }
            },

            scroll(e) {
                const { target } = e;
                const container = target.scrollingElement;
                const scrollHeight = container.scrollHeight;
                const scrollTop = container.scrollTop;
                const clientHeight = container.clientHeight;
                const scrollMePleaseDiv = document.getElementById('scrollMePlease');
                const divTop = scrollMePleaseDiv.offsetTop;
                const divHeight = scrollMePleaseDiv.offsetHeight;
                if(this.page < 6){
                if (scrollTop + clientHeight >= divTop && scrollTop <= divTop + divHeight && !this.loading && !this.stopCall
                    && this.scrollable) {
                            this.page++;
                            this.getProductAxios();
                        }
                if(this.page === 6)
                {
                    this.scrollable = false;
                }
                }
            },
            deleteLaravel() {
                const element = document.getElementById('laravel-base');
                if (element) {
                    element.remove();
                }
            },
            nameBrand(val) {
                return this.brands.find(x => x.id === val).title;
            },
            nameFilter(val) {
                for (const filter of this.filters) {
                    const child = filter.children.find(child => child.id === val);
                    if (child) {
                        return child.title;
                    }
                }
                return '';
            },
            removeItem(name, key = null) {
                if (typeof this[name] === 'object') {
                    this[name].splice(this[name].indexOf(key), 1);
                } else if (typeof this[name] === 'number' || typeof this[name] === 'boolean') {
                    this[name] = 0;
                } else if (typeof this[name] === 'string') {
                    this[name] = "";
                }
                this.updateUrlParams();
            },
            updateUrlParams() {
                const queryString = new URLSearchParams();
                if (this.selectedBrands.length > 0) {
                    queryString.set('selectedBrands', this.selectedBrands.join('_'));
                }
                if (this.selectedFilters.length > 0) {
                    queryString.set('selectedFilters', this.selectedFilters.join('_'));
                }
                if (this.discountedPrice.length > 0) {
                    queryString.set('discountedPrice', this.discountedPrice.join('_'));
                }
                if (this.sortBy) {
                    queryString.set('sortBy', this.sortBy);
                }
                if (this.priceRange) {
                    queryString.set('priceRange', this.priceRange);
                }

                let newUrl = window.location.pathname;
                const queryStr = queryString.toString();
                if (queryStr) {
                    newUrl += '?' + queryStr;
                }

                history.pushState({}, '', newUrl);
            },


        },
        mounted() {
            // Initialize selectedBrands from URL params on page load
            const params = new URLSearchParams(window.location.search);
            if (params.has('selectedBrands')) {
                this.selectedBrands = params.get('selectedBrands').split('_').map(v => parseInt(v));
                this.deleteLaravel();
            }
            if (params.has('discountedPrice')) {
                this.discountedPrice = params.get('discountedPrice').split('_').map(v => parseInt(v));
                this.deleteLaravel();
            }

            if (params.has('sortBy')) {
                this.sortBy = params.get('sortBy');
                this.deleteLaravel();
            }
            if (params.has('selectedFilters')) {
                this.selectedFilters = params.get('selectedFilters').split('_').map(v => parseInt(v));
                this.deleteLaravel();
            }
            if (params.has('priceRange')) {

                this.priceRange = params.get('priceRange');
                this.minPrice = this.priceRange.split('_')[0];
                this.maxPrice = this.priceRange.split('_')[1];
                this.deleteLaravel();
            }
            if (params.has('selectedFilters')) {
                this.selectedFilters = params.get('selectedFilters').split('_').map(v => parseInt(v));
                this.deleteLaravel();
            }
        },
        watch: {
            selectedBrands: {

                handler: async function (newVal) {
                    this.filterLoading = true;
                    this.products = [];
                        this.deleteLaravel();
                        this.brand_id = newVal;
                        this.page = 1;
                       await this.getProductAxios();
                    this.filterLoading = false;
                    this.updateUrlParams();

                },
                deep: true
            },
            discountedPrice: {
                handler: async function () {
                    this.filterLoading = true;
                    this.products = [];
                 this.deleteLaravel();
                 this.page = 1;
                 this.discounted_price = this.discounted_price === 1 ? 0 : 1;
                 await this.getProductAxios();
                    this.filterLoading = false;
                    this.updateUrlParams();

                },
                deep: true
            },
            selectedFilters: {
                handler: async function (newVal) {
                    this.filterLoading = true;
                    this.products = [];
                        this.deleteLaravel();
                        this.filter_id = newVal;
                        this.page = 1;
                        await this.getProductAxios();
                    this.filterLoading = false;
                    this.updateUrlParams();

                },
                deep: true
            },
            sortBy: {
                handler: async function (sortMe) {
                    this.filterLoading = true;
                    this.products = [];
                    if (sortMe) {
                        this.deleteLaravel();
                        this.page = 1;
                        this.sort_by = sortMe;
                        await this.getProductAxios();
                    } else {
                        this.page = 1;
                        this.sort_by = "";
                        this.discounted_price = 0;

                        await this.getProductAxios();
                    }
                    this.filterLoading = false;
                    this.updateUrlParams();

                },
                deep: true
            },
            productTitle(){
                this.filterLoading = true;
                this.isFilter = true;
                this.products = [];
                this.deleteLaravel();
                this.products = [];
                this.titleLoading = true;
                this.page = 1;
                setTimeout(() => {
                    this.getProductAxios();
                }, 200);
                this.filterLoading = false;
            },
        },
        computed: {
            searchedBrands: function () {
                if (this.searchBrand !== '') {

                    return this.brands.filter((brand) => {
                        return brand.title.toLowerCase().includes(this.searchBrand.toLowerCase());
                    });
                } else {
                    return this.brands;
                }
            },
            searchedChildren() {
                return (filter) => {
                    if (this.searchFilter !== '') {
                        return filter.children.filter(child => child.title.toLowerCase().includes(this.searchFilter.toLowerCase()));
                    } else {
                        return filter.children;
                    }
                };
            },

        },

    });
</script>
