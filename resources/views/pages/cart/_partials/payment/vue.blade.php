<script type="application/javascript">
    new Vue({
        el: '#app',
        data: {
        discountCode : '{{@$basket->discount->title}}',
        discountId : '{{@$basket->discount->title}}',
            finalPriceSum: 0,
            priceSum: 0,
            priceDiscount: 0,
            priceCart: 0,
            priceShipping: '',
            discountAmount: 0,
            priceLoading : false,

        },
        methods: {
            async addDiscount() {
                try {
                   const response =await axios.post('{{ route('basket.add-discount') }}', {
                        discount_code: this.discountCode
                    });
                   console.log(response.data.success)
                   if(response.data.success === true){
                       Swal.fire({
                           icon: 'info',
                           text: response.data.message,
                           toast: true,
                           position: 'top-end',
                           showConfirmButton: false,
                           timer: 5000
                       });
                       this.discountId = response.data.discount_id;

                   }else{
                       Swal.fire({
                           icon: 'info',
                           text: response.data.message,
                           showConfirmButton: true,
                           confirmButtonText: 'باشه',
                           timer: 5000
                       });
                       this.discountId = '';
                       this.discountCode = '';
                   }
                    await this.getPrice();
                        return false;

                } catch (error) {
                    console.error("Error removing item:", error);
                }

            },
            async deleteDiscount() {
                const response = await axios.get('{{ route('basket.delete-discount') }}');

                    Swal.fire({
                        icon: 'info',
                        text: 'کد تخفیف با موفقیت حذف شد',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                    });
                this.discountId = '';
                this.discountCode = '';
                await this.getPrice(true);
                    return false;


            },
             warnRequired(fieldName) {
              event.preventDefault();
                 Swal.fire({
                     icon: 'error',
                     text:  fieldName + ' اجباری است.',
                     toast: true,
                     position: 'top-end',
                     showConfirmButton: false,
                     timer: 5000
                 });
                 return false;
              },
            //price
            async getPrice(load  = true) {
                this.priceLoading = load;

                try {
                    const response = await axios.get('{{ route('basket.order-price') }}');
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
                    this.discountAmount = parseInt(response.data.discount_amount) !== 0
                        ? parseInt(response.data.discount_amount).toLocaleString() + ' تومان '
                        : 0;

                } catch (error) {
                    console.error("Error fetching items: ", error);
                } finally {
                    this.priceLoading = false;
                }

            },
        },
        async mounted() {
            await this.getPrice(true);
        },
        watch: {},
        computed: {},

    });
</script>
