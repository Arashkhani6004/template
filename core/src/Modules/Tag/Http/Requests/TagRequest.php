<?php

namespace Rahweb\CmsCore\Modules\Tag\Http\Requests;

use Rahweb\CmsCore\Modules\General\Rules\UrlRule;
use Rahweb\CmsCore\Modules\Tag\Entities\Tag;
use Rahweb\CmsCore\Modules\Blog\Rules\BlogRule;
use Rahweb\CmsCore\Modules\Page\Entities\Page;
use Rahweb\CmsCore\Modules\Page\Rules\PageRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class TagRequest extends FormRequest
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
            'url' => ['required', new UrlRule($id,Tag::class)],
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
