<?php

namespace Rahweb\CmsCore\Modules\Product\Http\Requests;

use Rahweb\CmsCore\Modules\General\Rules\UrlRule;
use Rahweb\CmsCore\Modules\Blog\Entities\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SpfRequest extends FormRequest
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
            'properties' => 'array',
            'tags' => 'array',
            'specification_product_values' => 'array',
            'specifications' => 'array',
        ];
    }
    public function messages()
    {
        return [
            'properties.array'=>'  ویژگی ها بصورت آرایه باید باشد.',
            'tags.array'=>'  تگ ها بصورت آرایه باید باشد.',
            'specification_product_values.array'=>'  مشخصه های نوشتاری آرایه باید باشد.',
            'specifications.array'=>'  مشخصه های انتخابی بصورت آرایه باید باشد.',
        ];
    }
}
