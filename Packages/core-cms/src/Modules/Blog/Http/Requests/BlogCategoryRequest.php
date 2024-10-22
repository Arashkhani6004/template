<?php

namespace Rahweb\CmsCore\Modules\Blog\Http\Requests;

use Rahweb\CmsCore\Modules\General\Rules\UrlRule;
use Rahweb\CmsCore\Modules\Course\Rules\CourseCategoryRule;
use Rahweb\CmsCore\Modules\Blog\Entities\BlogCategory;
use Rahweb\CmsCore\Modules\Blog\Rules\BlogCategoryRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BlogCategoryRequest extends FormRequest
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
            'url' => ['required', new UrlRule($id,BlogCategory::class)],
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'  عنوان اجباری است.',
            'url.required' => '  آدرس اجباری است',
        ];
    }
}
