<script>
    new Vue({
        el: "#app",
        data: {
            selectedMonth: '{{isset(\Illuminate\Support\Facades\Auth::user()->birthday) ? $date[1] : ''}}',
            isReadonlyfull_name: true,
            isReadonlymobile: true,
            isDisabledyear: true,
            isDisabledmonth: true,
            isDisabledday: true,
            months: monthsData,
            selectedDay: '{{ isset(\Illuminate\Support\Facades\Auth::user()->birthday) ? $date[2] : '' }}',
            daysInMonth: [],

        },
        mounted() {
            this.initializeDaysInMonth();
        },
        methods: {
            initializeDaysInMonth() {
                if (this.selectedMonth && this.months[this.selectedMonth]) {
                    const maxDays = this.months[this.selectedMonth].max;
                    this.daysInMonth = Array.from({ length: maxDays }, (_, i) => i + 1);

                    // Check if selectedDay is valid for the current month
                    if (!this.daysInMonth.includes(Number(this.selectedDay))) {
                        this.selectedDay = this.daysInMonth.length > 0 ? this.daysInMonth[0] : '';
                    }
                }
            },
            changeMonth(month) {
                if (month && this.months[month]) {
                    const maxDays = this.months[month].max;
                    this.daysInMonth = Array.from({ length: maxDays }, (_, i) => i + 1);
                } else {
                    this.daysInMonth = [];
                }
            },

            changeState(refName) {
                console.log(refName)
                const input = this.$refs[refName];

                // تغییر وضعیت readonly و disabled
                if (input.hasAttribute('readonly')) {
                    input.removeAttribute('readonly');
                    const propertyName = `isReadonly${refName}`;
                    this[propertyName] = false;

                }

                if (input.hasAttribute('disabled')) {
                    input.removeAttribute('disabled');
                    const propertyName = `isDisabled${refName}`;
                    this[propertyName] = false;
                }
            }

        },
    });
</script>
