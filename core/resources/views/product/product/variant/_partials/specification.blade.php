
<div id="spf-elements" class="p-0">


        <div class="bg-light border p-3 rounded-5 mb-3 position-relative">
            <h4 class="p-0" style="font-weight: bold;">
                موجودی و قیمت متغییر ها             </h4>
            <button type="button"
                    @click="addVariant"
                    class="btn btn-lg btn-outline-success rounded-custom btn-sm btn-add-form d-flex align-items-center"
            >
                <i class="bi bi-plus d-flex my-0"></i>
                افزودن
            </button>
            <hr>
            <div class="bg-light p-1">
                <div class="row w-100" v-for="(variant, index2) in variants" :key="index2">
                    <input type="hidden" :name="'variants[' + index2 + '][variant_id]'" :value="variant?.id">
                    <div class="col-xl-12 col-sm-12 col-xs-12 p-2">
                        <label class="col-form-label" style="font-weight: bold;"> متغییر شماره @{{ index2+1 }}</label>
                        <button type="button"
                                @click="deleteVariant(index2)"
                                class="btn btn-sm me-2 align-items-center"
                        >
                            <i class="d-flex bi bi-trash3 color-custom2 fs-5"></i>
                        </button>
                    </div>
                    <div v-for="specification in selectSpecifications" :key="specification.id" class="col-xxl-6 col-sm-6 p-2">
                        <div class="form-group">
                            <label class="form-label" for="specification">
                                @{{ specification.title }}
                            </label>

                            <div class="position-relative mb-2 border overflow-hidden rounded-5 m-1 row">
                                <input type="text" v-model="valueTitles[specification.id]"
                                       class="form-control form-control-sm rounded-5 border-0"
                                       :style="specification.is_color == 1 ? 'height: 100%;width:40%' : 'height: 100%;width:80%'"
                                       placeholder="عنوان مقدار جدید">
                                <input v-if="specification.is_color == 1" style="width:40%" type="color"
                                       v-model="valueColors[specification.id]"
                                       class="form-control form-control-sm rounded-5 border-0"
                                       placeholder="انتخاب رنگ">
                                <button @click="saveValue(specification.id)"
                                        class="btn btn-success btn-sm p-2 rounded-0 border-0 shadow-none position-absolute top-0 bottom-0 end-0"
                                        type="button" style="width: 20%;">
                               <span>
                                    <i class="bi bi-download"></i>
                                   افزودن
                               </span>
                                </button>
                            </div>
                            <v-select
                                v-model="variant.specification_id"
                                @input="setSelected($event,specification.id)"
                                :options="specification.children"
                                :reduce="item => item.id"
                                key="id"
                                label="title"
                                name="specifications"
                                placeholder="انتخاب کنید"
                            >
                            </v-select>
                            <input type="hidden" :name="'variants[' + index2 + '][specification_id]'" :value="variant.specification_id">
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-12 col-xs-12 p-2 mt-5">
                        <label class="form-label">
                            موجودی
                        </label>
                        <input numberCms class="form-control rounded-custom" :name="'variants[' + index2 + '][stock]'" placeholder="موجودی را وارد کنید..." v-model="variant.stock" requiredCms>
                    </div>
                    <div class="row w-100 m-0" >
                        <div class="col-xl-6 col-sm-12 col-xs-12 p-2">
                            <label class="form-label">
                                قیمت (تومان)
                            </label>
                            <input numberCms class="form-control rounded-custom" :name="'variants[' + index2 + '][price]'" placeholder="قیمت (تومان) را وارد کنید..." v-model="variant.price" requiredCms>
                        </div>

                        <div class="col-xl-6 col-sm-12 col-xs-12 p-2">
                            <label class="form-label">
                                قیمت با تخفیف (تومان)
                            </label>
                            <input numberCms class="form-control rounded-custom" :name="'variants[' + index2 + '][discounted_price]'" placeholder="قیمت با تخفیف (تومان) را وارد کنید..." v-model="variant.discounted_price" requiredCms>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <div class="row w-100">

        </div>
    </div>

@push('scripts')
    <script type="text/javascript">
        new Vue({
            el: "#spf-elements",
            data: {
                productId: {{ @$product->id }},
                mainVariantSpecificationId: {{ @$product->main_variant_specification_id }},
                specifications: @json($sortedSpecifications),
                selectedSpecificationIds: @json($product->specifications),
                selectedSps: [],
                selectSpecifications: [],
                loading: false,
                valueTitles: {},
                valueColors: {},
                //
                variants: @json($product->variants),
            },
            methods: {
                //add spfs
                sortSpecifications() {
                    this.selectSpecifications = this.specifications.filter(spec => spec.type === 'select');
                    this.selectSpecifications = this.specifications.filter(spec => spec.type === 'select' && spec.id === this.mainVariantSpecificationId);
                },
                addValue(specification) {
                    specification.product_values.push({value: ""});
                },
                async deleteValue(specification, valueIndex) {
                    if (specification.product_values[valueIndex]?.id) {
                        await this.deleteMainValue(specification.product_values[valueIndex].id);
                    }
                    specification.product_values = specification.product_values.filter((_, index) => {
                        return index !== valueIndex
                    });
                },
                async deleteMainValue(id) {
                    this.loading = true;
                    try {
                        await axios.get('{{ route('admin.product-property-spf-tag.delete-product-specification') }}/' + id);
                    } catch (error) {
                        console.error(error);
                    } finally {
                        this.loading = false;
                    }
                },
                async saveValue(specificationId) {
                    try {
                            if(this.valueTitles[specificationId].trim().length != 0){
                                let formData = new FormData();
                                formData.append("title", this.valueTitles[specificationId]);
                                formData.append("color_code", this.valueColors[specificationId]);
                                formData.append("parent_id", specificationId);
                                const response = await axios.post('{{ route('admin.specification-value.save-values') }}', formData);
                                // مقدار جدید ذخیره‌شده را به children مربوطه اضافه کنید
                                const newValue = {
                                    id: response.data.id, // فرض کنید سرور ID جدید را برمی‌گرداند
                                    title: this.valueTitles[specificationId],
                                    color_code: this.valueColors[specificationId]
                                };

                                // پیدا کردن مشخصه مورد نظر
                                const specification = this.selectSpecifications.find(spec => spec.id === specificationId);
                                if (specification) {
                                    specification.children.push(newValue);
                                }
                                Swal.fire({
                                    icon: 'success',
                                    text: "با موفقیت ذخیره شد",
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 5000
                                });
                            }
                            else{
                                Swal.fire({
                                    icon: 'error',
                                    text: "لطفا مقدار مشخصه را پر کنید",
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 5000
                                });
                            }


                    } catch (err) {
                        Swal.fire({
                            icon: 'error',
                            text: "با خطا مواجه شدید",
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000
                        });
                    }
                    this.$set(this.valueTitles, specificationId, ''); // پاکسازی ورودی متنی برای مشخصات فعلی
                    this.$set(this.valueColors, specificationId, ''); // پاکسازی ورودی متنی برای مشخصات فعلی
                },
                initializeSelectedSps() {
                    this.selectSpecifications.forEach(spec => {
                        let specifications = this.selectedSpecificationIds;
                        let filteredSpecs = specifications.filter(product_specification => {
                            return product_specification.parent_id == spec.id;
                        }).map(filtered_spec => {
                            return filtered_spec.id;
                        });
                        this.$set(this.selectedSps, spec.id, filteredSpecs);
                    });
                },

                setSelected(event, id) {
                    this.$set(this.selectedSps, id, event);
                },
                //add variants
                async getVariants() {
                    this.loading = true;
                    try {
                        const response = await axios.get(`{{ route('admin.product-variant.list') }}?product_id=${this.productId}`);
                        if (response.data.variants.length > 0) {
                            this.variants = response.data.variants;
                        } else {
                            this.addVariant();
                        }

                    } catch (error) {
                        console.error(error);
                    } finally {
                        this.loading = false;
                    }
                },
                addVariant() {
                    this.variants.push({price: "", discounted_price: "",stock:"",specification_id:""});
                },
                async deleteVariant(faqIndex) {
                    if (this.variants[faqIndex]?.id) {
                        await this.deleteMainVariant(this.variants[faqIndex].id);
                    }
                    this.variants = this.variants.filter((_, index2) => {
                        return index2 !== faqIndex
                    });
                },
                async deleteMainVariant(id) {
                    this.loading = true;
                    try {
                        await axios.get('{{ route('admin.product-variant.delete') }}/' +id);
                        this.getVariants();
                    } catch (error) {
                        console.error(error);
                    } finally {
                        this.loading = false;
                    }
                },
                //validate
                resetErrorElements(inputs) {
                    inputs.forEach(element => {
                        element.style.border = '';
                        const previousError = element.nextSibling;
                        if (previousError && previousError.tagName === 'P') {
                            previousError.parentNode.removeChild(previousError);
                        }
                    })
                    return true;
                },
                errorsGenerator(inputs) {
                    const inputErrors = [];
                    inputs.forEach(element => {
                        const errors = [];
                        const isEmpty = element.value.trim() === '';

                        if (element.hasAttribute("requiredCms")) {
                            if (isEmpty) {
                                errors.push({message: "وارد کردن مقدار الزامیست", validation: "requiredCms"});
                            }
                        }



                        if (element.hasAttribute("numberCms")) {
                            var numberPattern = /^[\d۰۱۲۳۴۵۶۷۸۹]+$/;
                            if (!isEmpty && !numberPattern.test(element.value)) {
                                errors.push({message: "فقط عدد وارد کنید", validation: "numberCms"});
                            }
                        }

                        if (errors.length > 0) {
                            inputErrors.push({element: element, errors: errors});
                        }
                    });
                    return inputErrors;
                },
                clearError(element) {
                    console.log(element);
                    element.style.border = '';
                    const previousError = element.nextSibling;
                    if (previousError && previousError.tagName === 'P') {
                        previousError.parentNode.removeChild(previousError);
                    }
                },
                addListenerInput(element) {
                    const vm = this;
                    element.addEventListener('input', function () {
                        vm.clearError(element);
                    });
                    element.addEventListener('change', function () {
                        vm.clearError(element);
                    });
                    return true;
                },
                validateForm(submitEvent) {
                    const inputs = submitEvent.target.querySelectorAll('input,select,textarea');
                    this.resetErrorElements(inputs);
                    const errors = this.errorsGenerator(inputs);
                    const selectedServiceErrors = this.rates.filter(rate => !rate.selectedService).length > 0;

                    if (errors.length > 0 || selectedServiceErrors) {
                        errors.forEach(error => {
                            const errorElement = document.createElement('p');
                            errorElement.textContent = error.errors[0].message;
                            errorElement.style.color = "red";
                            errorElement.style.display = 'none';
                            error.element.style.border = '1px solid red';
                            errorElement.style.display = 'block';
                            error.element.parentNode.insertBefore(errorElement, error.element.nextSibling);
                            this.addListenerInput(error.element);
                        })
                        if (this.rates.some(rate => !rate.selectedService)) {
                            this.rates.forEach(rate => {
                                const selectElement = document.getElementById(`select-${rate.id}`);
                                selectElement.style.border = '';
                                const previousError = selectElement.nextSibling;
                                if (previousError && previousError.tagName === 'P') {
                                    previousError.parentNode.removeChild(previousError);
                                }
                                const errorElement = document.createElement('p');

                                errorElement.textContent = "وارد کردن مقدار الزامیست";
                                errorElement.style.color = "red";
                                errorElement.style.display = 'none';
                                selectElement.style.border = '1px solid red';
                                selectElement.style.borderRadius="10px";
                                errorElement.style.display = 'block';
                                selectElement.parentNode.insertBefore(errorElement, selectElement.nextSibling);
                                this.addListenerInput(selectElement);
                            });
                        }

                        Swal.fire({
                            icon: 'error',
                            text: "کاربر گرامی اطلاعات فرم را به درستی پر کنید",
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000
                        });

                        return false;
                    } else {
                        submitEvent.target.submit();
                    }
                },
                sanitizeValueNumber(value) {
                    const validCharacters = /[۰-۹0-9]/g;
                    return value.match(validCharacters)?.join('') || '';
                },
            },
            async mounted() {
                await this.sortSpecifications();
                this.initializeSelectedSps();
                let vm = this;
                let numberInputs = document.querySelectorAll("[numberCms]");
                numberInputs.forEach(item => {
                    item.addEventListener('input', function (event){
                        event.target.value = vm.sanitizeValueNumber(event.target.value);
                    });
                });
            },
            watch: {
                selectedSps(val) {
                    console.log('selectedSps');
                    console.log(val);
                }
            }
        });
    </script>
@endpush





