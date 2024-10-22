<?php

namespace Rahweb\CmsCore\Modules\Order\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\General\Rules\UrlRule;
use Rahweb\CmsCore\Modules\Product\Entities\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class CountRule implements Rule
{
    protected $count;

    public function __construct($count)
    {
        $this->count = $count;
    }

    public function passes($attribute, $value)
    {
        if (intval(NumberHelper::persian2LatinDigit($this->count)) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function message()
    {
        return '  تعداد کد مورد نیاز اجباری است.';
    }
}
class DiscountRequest extends FormRequest
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
            'amount' => 'required',
            'count' => ['required', new CountRule($request->input('count'))],

        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'  عنوان اجباری است.',
            'amount.required'=>'  مقدار اجباری است.',
            'count.required' => '  تعداد کد مورد نیاز اجباری است',
        ];
    }
}
