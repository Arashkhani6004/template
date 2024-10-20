<script>
    new Vue({
        el: '#search-vue',
        data: function () {
            return {
                //search
                searchLoading: false,
                searchInput: '',
                search: '',
                searchedServices: [],
                searchedBlogs: [],
                searchedPortfolios: [],
                searchedProducts: [],
                searchedProductCategories: [],
                searchedBrands: [],
                noResults: false,
            }
        },
        methods: {
            //search Start

            async searchResult() {
                this.searchInput = event.target.value;
                if (this.searchInput.length > 1) {
                    this.searchLoading = true;
                    const response = await axios.get('{{$core_url.'api/v1/search-api'}}?search=' + this.searchInput);
                    this.searchedServices = response.data.data.searched_services;
                    this.searchedBlogs = response.data.data.searched_blogs;
                    this.searchedPortfolios = response.data.data.searched_portfolios;
                    this.searchedProducts = response.data.data.searched_products;
                    this.searchedProductCategories = response.data.data.searched_categories;
                    this.searchedBrands = response.data.data.searched_brands;
                    if (this.searchedServices.length + this.searchedBlogs.length + this.searchedPortfolios.length
                        + this.searchedProductCategories.length + this.searchedBrands.length
                        + this.searchedProducts.length == 0) {
                        this.noResults = true;
                    } else {
                        this.noResults = false;
                    }
                    this.searchLoading = false;
                } else {
                    this.searchedServices = [];
                    this.searchedBlogs = [];
                    this.searchedPortfolios = [];
                    this.searchedProducts = [];
                    this.searchedProductCategories = [];
                    this.searchedBrands = [];
                }


            },
            colorResult(sentence) {
                if (sentence == null) {
                    return sentence;
                }
                this.searchInput = this.searchInput.toLowerCase();
                const mytence = sentence.toLowerCase();
                const myArray = mytence.split(this.searchInput);
                let myString = "";

                myArray.forEach((item, key) => {
                    myString += item;
                    if (!((key + 1) == myArray.length)) {
                        myString += "<span class='color-theme-two'>" + this.searchInput + "</span>";
                    }
                })
                return myString;
            },
        }
    });
</script>
