<?php

namespace Rahweb\CmsCore\Modules\Product\Http\Requests;

use Rahweb\CmsCore\Modules\General\Rules\UrlRule;
use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Rahweb\CmsCore\Modules\Product\Entities\ProductCategory;
use Rahweb\CmsCore\Modules\Product\Rules\ProductCategoryRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ParentIdRule implements Rule
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function passes($attribute, $value)
    {
        if ($this->id && $value == $this->id) {
            return false;
        } else {
            return true;
        }
    }

    public function message()
    {
        return 'نمیتوان زیر مجموعه خودش قرار بگیرد';
    }
}

class ProductCategoryRequest extends FormRequest
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
        $id = $request->route('id');
        return [
            'title' => 'required',
            'url' => ['required', new UrlRule($id, ProductCategory::class)],
            'parent_id' => [new ParentIdRule($id), new ProductCategoryRule($id)],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'عنوان اجباری است.',
            'url.required' => 'آدرس اجباری است',
        ];
    }
}
