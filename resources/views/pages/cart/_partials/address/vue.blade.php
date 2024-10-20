<script type="application/javascript">
    new Vue({
        el: '#app',
        data: {
            items: [],
            loadingList : false,
            loadingShipment : false,
            loadingAddress : false,
            priceLoading : true,
            finalPriceSum: 0,
            priceSum: 0,
            priceDiscount: 0,
            priceCart: 0,
            priceShipping: '',
            locations:[],
            selectedState: '',
            selectedCity: '',
            states: [],
            cities: [],
            receiptorMobile: '',
            receiptorName: '',
            postalCodeForm: '',
            address: '',
            addressId: '',
            defaultAddressId: '{{@$basket->address_id}}',
            defaultShippingMethodId: '{{@$basket->shipping_method_id}}',
            shippingMethods: [],
        },
        methods: {
            async getAddresses() {

                this.loadingList = true;
                this.loadingShipment = false;
                const response = await axios.get('{{route('basket.address-list')}}');
                this.locations = response.data.addresses.data;
                if(this.locations.length === 1){
                this.defaultAddressId = this.locations[0].id;
                }
                this.loadingList = false

            },
            async getSates() {
                const response = await axios.get('{{route('basket.states')}}');
                this.states = response.data.states;

            },
            async getCities() {
                this.loadingAddress = true;
                const response = await axios.post('{{route('basket.cities')}}');
                this.cities = response.data.cities;
                this.loadingAddress = false;

            },

            async setCities() {
                this.loadingAddress = true;
                const response =   await axios.post('{{ route('basket.cities') }}', {
                    state_id: this.selectedState,
                });
                this.cities = response.data.cities;
                this.loadingAddress = false;
            },
            async editAddress(id) {
                this.loadingAddress = true;
                const response =   await axios.post('{{ route('basket.address-edit') }}', {
                    address_id: id,
                });
                this.selectedState = response.data.address.state_id;
                this.selectedCity = response.data.address.city_id;
                this.address = response.data.address.address;
                this.postalCodeForm = response.data.address.postal_code;
                this.receiptorName = response.data.address.receiptor_full_name;
                this.receiptorMobile = response.data.address.receiptor_mobile;
                this.addressId = response.data.address.id;
                await this.setCities();
                this.loadingAddress = false;
            },
            async getShippingMethod() {
                this.loadingShipment = true;
                const response =   await axios.post('{{ route('basket.shipments') }}', {
                    address_id: this.defaultAddressId,
                });
                this.loadingShipment = false;
                this.shippingMethods = response.data.shipping_methods;
            },
            async setShippingMethod() {
                const response =   await axios.post('{{ route('basket.set-shipments') }}', {
                    shipping_method_id: this.defaultShippingMethodId,
                });
                this.getPrice();

            },
            formatPrice(value) {
                if (!value) return '';
                return new Intl.NumberFormat().format(value);
            },
            //price
            async getPrice(load  = true) {
                this.priceLoading = load;

                try {
                    const response = await axios.get('{{ route('basket.address-price') }}');
                    console.log('response.data.price_shipping');
                    console.log(response.data.price_shipping);
                    this.finalPriceSum = parseInt(response.data.final_price_sum) !== 0
                        ? parseInt(response.data.final_price_sum).toLocaleString() + ' تومان '
                        : 0;
                    this.priceSum = parseInt(response.data.price_sum) !== 0
                        ? parseInt(response.data.price_sum).toLocaleString() + ' تومان '
                        : 0;
                    this.priceDiscount = parseInt(response.data.price_discount) !== 0
                        ? parseInt(response.data.price_discount).toLocaleString() + ' تومان '
                        : 0;
                    if (response.data.price_shipping === '' || response.data.price_shipping === null) {
                        console.log()
                        this.priceShipping = 'نامشخص';
                    } else {
                        this.priceShipping = parseInt(response.data.price_shipping) !== 0
                            ? parseInt(response.data.price_shipping).toLocaleString() + ' تومان '
                            : 'ارسال رایگان';
                    }
                    this.priceCart = parseInt(response.data.price_cart) !== 0
                        ? parseInt(response.data.price_cart).toLocaleString() + ' تومان '
                        : 0;

                } catch (error) {
                    console.error("Error fetching items: ", error);
                } finally {
                    this.priceLoading = false;
                }

            },
            checkForm(e, edit) {
                e.preventDefault();
                this.receiptorMobile = this.receiptorMobile.trim();
                if (this.receiptorMobile.length !== 11) {
                    swal("", "شماره گیرنده حتما باید ۱۱ رقم باشد", "error", {
                        button: "باشه",
                    });
                    return false;
                }
                if (this.postalCodeForm != null && this.postalCodeForm.trim() !== "") {
                    this.postalCodeForm = this.postalCodeForm.trim();
                    if (this.postalCodeForm.length !== 10) {
                        swal("", "کد پستی حتما باید ۱۰ رقم باشد", "error", {
                            button: "باشه",
                        });

                    } else {
                        if (edit === true) {
                            document.getElementById("editForm").submit()

                        } else {
                            document.getElementById("addForm").submit()
                        }

                    }
                } else {
                    if (edit === true) {
                        document.getElementById("addForm").submit()
                    } else {
                        document.getElementById("editForm").submit()
                    }
                }
            },


        },
        async mounted() {
            await this.getAddresses();
            await this.getSates();
          if(this.defaultAddressId){
            await this.getShippingMethod();
          }
            await this.getPrice(true);
        },
        watch: {},
        computed: {},

    });
</script>
