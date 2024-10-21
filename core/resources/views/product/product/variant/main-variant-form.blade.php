@if($product->main_variant_specification_id != null)
<div role="alert" class="alert alert-danger d-block">
 توجه داشته باشید با تغییر متغییر اصلی، تمامی متغییرهای مربوطه حذف می شوند
</div>
@endif
<form
    action="{{route('admin.product-variant.create-main')}}"
    method="POST"
    enctype="multipart/form-data"
    id="cms-form"
    @submit.prevent="validateForm"
>
    @csrf
    <input type="hidden" name="product_id" value="{{@$product->id}}">

    <div class="col-xxl-6 col-sm-6 p-2 d-flex align-items-end justify-content-start me-auto">
        <div class="mx-1">
            <x-cms-select
                name="main_variant_specification_id"
                label=" انتخاب متغییر اصلی"
                :options="$sortedSpecifications"
                optionValue="id"
                optionLabel="title"
                :searchable="true"
                :selectedOption="isset($product->main_variant_specification_id) ? $product->main_variant_specification_id : null"
            />
        </div>
        <button type="submit" id="submitFormCms" class="btn btn-custom rounded-custom w-fit px-3 py-2 mx-1">
            ذخیره
        </button>
    </div>
</form>
