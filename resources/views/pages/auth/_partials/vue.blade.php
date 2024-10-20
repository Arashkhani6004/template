<script>
    new Vue({
        el: "#app",
        data: {
            mobile: null,
            name: null,
            national_code: null,
            loading: false,
            userExists: true
        },
        methods: {
            disableSubmit() {
                this.loading = true;
                document.getElementById('submit-register').setAttribute('disabled', true);
                document.getElementById('auth-form').submit();
            },
            mobileValidation(mobile) {
                const mobileRegex = /^[0-9+۰-۹]+$/;
                if (!mobileRegex.test(mobile)) {
                    return 'در شماره همراه فقط عدد وارد کنید';
                } else if (mobile.length > 11) {
                    return "شماره همراه باید ۱۱ رقم باشد";
                } else if (mobile.length < 11) {
                    return "شماره همراه باید ۱۱ رقم باشد";
                }
                return true;
            },
            async checkUserExists() {
                if(this.mobileValidation(this.mobile) !== true){
                    Swal.fire({
                        icon: 'error',
                        text: `شماره همراه نامعتبر است.`,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                    });
                    return;
                }
                if (this.loading === true) {
                    return;
                }
                this.loading = true;
                const response = await axios.get('{{ route("auth.check-user-exists") }}?mobile=' + this.mobile);
                if (response.data) {
                    document.getElementById('auth-form').submit();
                } else {
                    this.loading = false;
                    this.userExists = false;
                }
            }
        }
    });
</script>
