@extends('CmsCore::_layouts.master')
@section('title','داشبورد')
@section('content')
<div id="app">
    <div>
        <h2>Select an image</h2>
        <input multiple type="file" @change="onFileChange">
    </div>
    <div v-if="images">
        <div v-for="(image, index) in images">
            <img :src="image" />
            <button @click="removeImage(index)">Remove image</button>
        </div>
    </div>
</div>
@push('styles')
<style>
    #app {
        text-align: center;
    }

    img {
        width: 30%;
        margin: auto;
        display: block;
        margin-bottom: 10px;
    }

    button {}
</style>
@endpush
@push('scripts')
<script
    src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js"></script>
<script src="{{asset('assets/admin/js/vue.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-router/3.4.9/vue-router.js"></script>
<script id="rendered-js">
    new Vue({
        el: '#app',
        data: {
            images: []
        },

        methods: {
            onFileChange(e) {

                var files = e.target.files || e.dataTransfer.files;
                if (!files.length) return;
                this.createImage(files);
            },
            createImage(files) {
                var vm = this;
                for (var index = 0; index < files.length; index++) {
                    if (window.CP.shouldStopExecution(0)) break;
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        const imageUrl = event.target.result;
                        vm.images.push(imageUrl);
                    };
                    reader.readAsDataURL(files[index]);
                } window.CP.exitedLoop(0);
            },
            removeImage(index) {
                this.images.splice(index, 1);
            }
        }
    });
    //# sourceURL=pen.js
</script>

@endpush
@endsection
