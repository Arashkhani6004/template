<?php

namespace Rahweb\CmsCore\Modules\Order\Http\Requests;

use Rahweb\CmsCore\Modules\General\Rules\UrlRule;
use Rahweb\CmsCore\Modules\Product\Entities\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ShippingMethodRequest extends FormRequest
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
        $id = $request->route('id'); // دریافت آیدی از رویت

        return [
            'title' => 'required',
            'price' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'  عنوان اجباری است.',
            'price.required' => '  قیمت اجباری است',
        ];
    }
}
