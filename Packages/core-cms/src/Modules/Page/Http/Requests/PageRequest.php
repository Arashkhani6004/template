<?php

namespace Rahweb\CmsCore\Modules\Page\Http\Requests;

use Rahweb\CmsCore\Modules\General\Rules\UrlRule;
use Rahweb\CmsCore\Modules\Blog\Rules\BlogRule;
use Rahweb\CmsCore\Modules\Page\Entities\Page;
use Rahweb\CmsCore\Modules\Page\Rules\PageRule;
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
        if ($value == $this->id) {
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
class PageRequest extends FormRequest
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

        switch ($this->segment(3)) {
            case 'create' :
                return [
                    'title' => 'required',
                    'url' => ['required', new UrlRule($id,Page::class)],
                    'image' => 'required',

                ];
                break;
            case 'edit' :
                return [
                    'title' => 'required',
                    'url' => ['required', new UrlRule($id,Page::class)],
                    'parent_id' => [new ParentIdRule($id)],



                ];
                break;
        }
    }
    public function messages()
    {
        return [
            'title.required'=>'  عنوان اجباری است.',
            'url.required' => '  آدرس اجباری است',
            'image.required' => '  تصویر اجباری است',
        ];
    }
}
