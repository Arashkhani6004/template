<?php

namespace Rahweb\CmsCore\Modules\Product\Http\Requests;

use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\General\Rules\UrlRule;
use Rahweb\CmsCore\Modules\Blog\Entities\Blog;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class PriceRule implements Rule
{
    protected $price;
    protected $discountedPrice;

    public function __construct($price, $discountedPrice)
    {
        $this->price = NumberHelper::persian2LatinDigit($price);
        $this->discountedPrice = NumberHelper::persian2LatinDigit($discountedPrice);

    }

    public function passes($attribute, $value)
    {
        if ($this->discountedPrice > $this->price) {
            return false;
        } else {
            return true;
        }
    }

    public function message()
    {
        return 'قیمت بعد از تخفیف نمیتواند بیشتر از قیمت اصلی باشد';
    }
}
class ProductRequest extends FormRequest
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
            'url' => ['required', new UrlRule($id,Product::class)],
            'discounted_price' => [new PriceRule($request->input('price'), $request->input('discounted_price'))],
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
