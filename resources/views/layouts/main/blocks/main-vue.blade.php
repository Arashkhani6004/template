<script>
    new Vue({
        el: '#{{$element_id}}',
        data: function () {
            return {
                branches: {!! Js::from($branches->toArray()) !!},
                mainBranch: {!! Js::from($main_branch->toArray()) !!},
            }
        }
    });
</script>
