<?php

namespace Rahweb\CmsCore\Modules\Product\Http\Requests;

use Rahweb\CmsCore\Modules\General\Rules\UrlRule;
use Rahweb\CmsCore\Modules\Blog\Entities\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MainVariantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {

        return [
            'main_variant_specification_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'main_variant_specification_id.required'=>'  انتخاب مشخصه اصلی الزامیست.',

        ];
    }
}
