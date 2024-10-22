<script src="{{asset('assets/admin/ckeditor/ckeditor.js')}}"></script>
<script>
    setTimeout(function(){
        var cks = document.getElementsByClassName('ckeditor4');
        Array.from(cks).forEach((el) => {
            CKEDITOR.replace("description", {
                language: 'fa',
                content: 'fa',
                removeButtons: 'Font,FontSize,PasteFromWord',
                filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form',
                on: {
                    instanceReady: function(event) {
                        event.editor._.forcePasteDialog = true;
                        event.editor.on('key', function(evt) {
                            if (evt.data.$.ctrlKey && evt.data.$.shiftKey && evt.data.dataKey === 86) { // 86 کد کلید V است
                                evt.data.preventDefault();
                                event.editor.execCommand('paste');
                            }
                        });
                    }
                }
            });
        });
    }, 100);
</script>

