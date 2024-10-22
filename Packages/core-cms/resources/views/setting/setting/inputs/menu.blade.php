<div id="menu-elements">
    <div class="col-sm-12 col-12 p-2">
        <button @click="addItem" type="button" class="btn btn-custom-b rounded-custom w-100">
            افزودن گزینه منو
        </button>
    </div>
    <p style="text-align: center;color: #aa4242;">
        توجه داشته باشید لینک هارو بدون آدرس سایت داخل فیلد URL قرار بدید. برای مثال : /blogs
    </p>
    <input name="menu_data" type="hidden" :value="JSON.stringify(items)" />
    <div class="row w-100 mt-1" v-for="(item,index) in items" style="border: 1px solid #7e73f1;border-radius: 10px;background: #d2a5ff14;">
        <div class="col-sm-4 col-12 p-2">
            <div class="form-group">
                <label for="">عنوان لینک</label>
                <input v-model="item.title" type="text" class="form-control bg-light rounded-custom"
                       placeholder="">
            </div>
        </div>
        <div class="col-sm-3 col-12 p-2">
            <div class="form-group">
                <label for="">نوع لینک</label>
                <select v-model="item.type" id="" class="form-select rounded-custom">
                    <option value="default">لینک صفحه</option>
                    <option value="product">دراپ داون محصولات</option>
                    <option value="service">دراپ داون خدمات</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4 col-12 p-2" v-if="item.type == 'default'">
            <div class="form-group">
                <label for="">URL صفحه</label>
                <input v-model="item.url" requiredcms="" type="text" class="form-control bg-light rounded-custom"
                       placeholder="" value="">
            </div>
        </div>

        <div class="col-sm-1 col-12 p-2">
            <button @click="deleteItem(index)" type="button" class="btn btn-custom-b rounded-custom w-fit"
                    style="margin: 1.3rem;">
                حذف
            </button>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('assets/admin/js/vue.js')}}"></script>
    <script type="text/javascript">
        new Vue({
            el: "#menu-elements",
            data: {
                items: @json(json_decode(@$data->value))
            },
            methods: {
                addItem() {
                    this.items.push({title: "", type: "default", url: ""});
                },
                deleteItem(index){
                    this.items.splice(index, 1);
                }
            }
        });
    </script>
@endpush
