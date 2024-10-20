<script type="application/javascript">
    new Vue({
        el: '#app',
        data: {
            items: [],
            totalQuantity: 0,
            itemListLoading : false,
            priceLoading : false,
            itemLoading : false,
            numberValue: 1,
            finalPriceSum: 0,
            priceSum: 0,
            priceDiscount: 0,
        },
        methods: {
            async getItems(load  = true) {
                this.itemListLoading = load;
                this.priceLoading = true;

                try {
                    const response = await axios.get('{{ route('basket.cart-items') }}');
                    this.items = response.data.basketCollection.data ? response.data.basketCollection.data : [];
                    this.totalQuantity = this.items.reduce((sum, item) => sum + parseFloat(item.quantity) || 0, 0);
                } catch (error) {
                    console.error("Error fetching items: ", error);
                } finally {
                    this.itemListLoading = false;
                }
                await this.getPrice(load);
            },
            async removeCart(itemId) {
                try {
                    await axios.post('{{ route('basket.cart-item-remove') }}', {
                        item_id: itemId
                    });
                    await this.getItems();
                } catch (error) {
                    console.error("Error removing item:", error);
                }
            },
            //changeQuantity
            increaseValue(index) {
                const checkQuantity = this.items[index].quantity;
                this.items[index].quantity = parseFloat(this.items[index].quantity) + 1;
                this.changeItem(this.items[index],checkQuantity,index);
            },
            decreaseValue(index) {
                if (this.items[index].quantity > 1) {
                    const checkQuantity = this.items[index].quantity;
                    this.items[index].quantity = parseFloat(this.items[index].quantity) - 1;
                    this.changeItem(this.items[index],checkQuantity,index);
                }
            },
            async changeItem(item,checkQuantity,index) {
                this.itemLoading = true;
                const response =   await axios.post('{{ route('basket.add') }}', {
                    product_id: item.product_id,
                    product_variant_id: item.variant_id,
                    quantity: item.quantity,
                    cart : true
                });
                this.itemLoading = false;
                if (response.data.success === false && response.data.button == false) {
                    Swal.fire({
                        icon: 'info',
                        text: response.data.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                    });
                    this.$set(this.items, index, {
                        ...item,
                        quantity: checkQuantity,
                    });
                    return false;
                }

                await this.getItems(false);


            },
            //price
            async getPrice(load  = true) {
                this.priceLoading = load;

                try {
                    const response = await axios.get('{{ route('basket.list-price') }}');
                    console.log(response.data.final_price_sum);
                    this.finalPriceSum = parseInt(response.data.final_price_sum) !== 0
                        ? parseInt(response.data.final_price_sum).toLocaleString() + ' تومان '
                        : 0;
                    this.priceSum = parseInt(response.data.price_sum) !== 0
                        ? parseInt(response.data.price_sum).toLocaleString() + ' تومان '
                        : 0;
                    this.priceDiscount = parseInt(response.data.price_discount) !== 0
                        ? parseInt(response.data.price_discount).toLocaleString() + ' تومان '
                        : 0;

                } catch (error) {
                    console.error("Error fetching items: ", error);
                } finally {
                    this.priceLoading = false;
                }
            },


        },
        async mounted() {
            await this.getItems();
        },
        watch: {},
        computed: {},

    });
</script>
