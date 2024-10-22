<script src="{{asset('assets/admin/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/admin/js/libscripts.bundle.js')}}"></script>
<script src="{{asset('assets/admin/js/template.js')}}"></script>
<script src="{{asset('assets/admin/js/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/admin/js/script.min.js')}}"></script>
<script src="{{asset('assets/admin/js/833bootstrap-select.min.js')}}"></script>

<script>
    $(document).ready(function() {
        // Prevent alert from closing dropdown
        $('.alert-dismissible .btn-close').click(function(event) {
            $(this).closest('.alert-dismissible').alert('close');
            event.stopPropagation();
        });
    });
    function dropClose(){
        const alerts = document.getElementById('drop-alert');
        alerts.classList.remove('show')
    }
    function dropClose2(){
        const alerts2 = document.getElementById('drop-alert2');
        alerts2.classList.remove('show')
    }

    const input = document.getElementById('openMenu');
    const div = document.getElementById('sidebar');
    let titleElements = document.querySelectorAll('.sidebar .title');
    input.addEventListener('click', () => {
        if (input.classList.contains('bi-record-circle')) {
            input.classList.remove('bi-record-circle');
            input.classList.add('bi-circle');
            div.style.width = '100px';
            for (const titleElement of titleElements) {
                titleElement.style.display = 'none';
            }
            input.classList.remove('d-flex');
            input.classList.add('d-none');

        } else if (input.classList.contains('bi-circle')) {
            input.classList.remove('bi-circle');
            input.classList.add('bi-record-circle');
            div.style.width = '260px';
            for (const titleElement of titleElements) {
                titleElement.style.display = 'flex';
            }
            input.classList.remove('d-none');
            input.classList.add('d-flex');
        }
    });
    div.addEventListener('mouseout', () => {
        if (input.classList.contains('bi-circle')) {
            div.style.width = '100px';
            for (const titleElement of titleElements) {
                titleElement.style.display = 'none';
            }
            input.classList.remove('d-flex');
            input.classList.add('d-none');
        }
    });
    div.addEventListener('mouseover', () => {
        if (input.classList.contains('bi-circle')) {
            div.style.width = '260px';
            for (const titleElement of titleElements) {
                titleElement.style.display = 'flex';
            }
            input.classList.remove('d-none');
            input.classList.add('d-flex');
        }
    });
</script>
{{--<script src="{{asset('assets/admin/js/form-validate.js')}}"></script>--}}
@stack('scripts')
