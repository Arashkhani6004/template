<script type="application/javascript">
    new Vue({
        el: '#app',
        data: {
            items: [],
            loadingList : false,
            loadingShipment : false,
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
            defaultAddressId: '',
            defaultShippingMethodId: '',
            shippingMethods: [],
        },
        methods: {
            async getAddresses() {

                this.loadingList = true;
                this.loadingShipment = false;
                const response = await axios.get('{{route('panel.address-list')}}');
                this.locations = response.data.addresses.data;
                this.loadingList = false

            },
            async getSates() {
                const response = await axios.get('{{route('panel.states')}}');
                this.states = response.data.states;

            },
            async getCities() {
                this.loadingAddress = true;
                const response = await axios.post('{{route('panel.cities')}}');
                this.cities = response.data.cities;
                this.loadingAddress = false;

            },

            async setCities() {
                this.loadingAddress = true;
                const response =   await axios.post('{{ route('panel.cities') }}', {
                    state_id: this.selectedState,
                });
                this.cities = response.data.cities;
                this.loadingAddress = false;
            },
            async editAddress(id) {
                this.loadingAddress = true;
                const response =   await axios.post('{{ route('panel.address-edit') }}', {
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

        },
        watch: {},
        computed: {},

    });
</script>
