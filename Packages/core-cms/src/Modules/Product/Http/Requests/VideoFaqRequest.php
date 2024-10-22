<?php

namespace Rahweb\CmsCore\Modules\Product\Http\Requests;

use Rahweb\CmsCore\Modules\General\Rules\UrlRule;
use Rahweb\CmsCore\Modules\Blog\Entities\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class VideoFaqRequest extends FormRequest
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
            'videos' => 'array',
            'faqs' => 'array',
        ];
    }
    public function messages()
    {
        return [
            'videos.array'=>'  ویدیوها بصورت آرایه باید باشد.',
            'faqs.array'=>'  سوالات متداول بصورت آرایه باید باشد.',
        ];
    }
}
