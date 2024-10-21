<script type="text/javascript">
    function confirmDelete(url) {
        Swal.fire({
            icon: 'warning',
            text: "آیا از حذف آیتم مطمئن هستید؟",
            showCancelButton: true,
            confirmButtonText: 'تایید و حذف',
            cancelButtonText: 'لغو',
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = url;
            }
        });
    }
</script>
