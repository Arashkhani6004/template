<script>
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
        el: '#samples',
        data: function () {
            return {
                services: [],
                samples: [],
                selectedService: "",
                loading: false,
                subServices: [],
                selectedSubService: '',
                servicesData: [],
                selectedSubServices: {}, // زیرگروه‌های انتخاب شده برای هر سطح
                samplesListAwait: 0,
                page: 1,
                stopCall: false,
                isFilter: false,
                selectedSubServiceLevel: {} // Track selected sub-service for each level
            }
        },
        methods: {
            async getServiceForFilter() {
                const response = await axios.get('{{$core_url.'api/v1/portfolio-filters'}}');
                this.services = response.data.data.services;
            },
            getChildren(service, level) {
                if (service.children && level > 1) {
                    return service.children.flatMap(child => this.getChildren(child, level - 1));
                } else if (level === 1) {
                    return service.children || [];
                }
                return [];
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
                if (scrollTop + clientHeight >= divTop && scrollTop <= divTop + divHeight && !this.loading && !this.stopCall) {
                    this.page++;
                    this.getSampleAxios();
                }
            },
            async getSampleAxios(selectedService) {
                if (this.loading) return;
                this.loading = true;
                const response = await axios.post('{{$core_url.'api/v1/portfolio-vue'}}', {
                    page: this.page,
                    service_id: selectedService,
                });
                if (this.page === 1) {
                    this.samples = response.data.data.samples;
                } else {
                    this.samples = [...this.samples, ...response.data.data.samples];
                }
                this.loading = false;
                this.lastPage = response.data.data.pageCount;
                if (response.data.data.currentPage === this.page || response.data.data.currentPage === 0) {
                    this.stopCall = true;
                } else {
                    this.stopCall = false;
                }
            },
            updateSubServices(level) {
                const parentLevel = level - 1;
                const selectedSubService = this.selectedSubServiceLevel[parentLevel];
                if (selectedSubService) {
                    const parentService = this.getServiceById(selectedSubService);
                    if (parentService) {
                        const children = this.getChildren(parentService, 1);
                        this.selectedSubServices[level] = children;
                        if(selectedSubService.length > 0){
                            this.isFilter = true;
                        }

                        // Always make an Axios call when a subservice is selected
                        this.page = 1;  // Reset the page number
                        this.samples = [];  // Clear the samples
                        this.getSampleAxios(selectedSubService);
                    } else {
                        this.isFilter = false;
                        this.selectedSubServices[level] = [];
                    }
                } else {
                    this.isFilter = false;
                    this.selectedSubServices[level] = [];
                }
                for (let i = level + 1; i <= 6; i++) {
                    this.selectedSubServiceLevel[i] = '';
                    this.selectedSubServices[i] = [];
                }
            },
            getServiceById(id) {
                function findService(services, id) {
                    for (const service of services) {
                        if (service.id === id) return service;
                        if (service.children) {
                            const childService = findService(service.children, id);
                            if (childService) return childService;
                        }
                    }
                    return null;
                }
                return findService(this.services, id);
            },
        },
        async mounted() {
            await this.getServiceForFilter();
        },
        watch: {
            selectedService(newValue) {
                const selectedService = this.services.find(service => service.id === newValue);
                if (selectedService) {
                    const children = this.getChildren(selectedService, 1);
                    this.selectedSubServices[1] = children;
                    this.isFilter = true;
                    // Always make an Axios call when the main service is selected
                    this.page = 1;  // Reset the page number
                    this.samples = [];  // Clear the samples
                    this.getSampleAxios(selectedService.id);
                } else {
                    this.isFilter = false;
                    this.selectedSubServices = {};
                }
                this.selectedSubServiceLevel = {};
                for (let i = 2; i <= 6; i++) {
                    this.selectedSubServices[i] = [];
                }
            }
        }
    });
</script>
