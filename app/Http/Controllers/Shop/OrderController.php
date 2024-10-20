<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Rahweb\CmsCore\Modules\Order\Entities\Bank;
use Rahweb\CmsCore\Modules\Order\Entities\Order;
use Rahweb\CmsCore\Modules\Order\Entities\OrderItem;
use Rahweb\CmsCore\Modules\Order\Http\Resources\BasketCollection;
use Rahweb\CmsCore\Modules\Order\Services\BankService;
use Rahweb\CmsCore\Modules\Order\Services\BasketService;
use Rahweb\CmsCore\Modules\Order\Services\DiscountService;
use Rahweb\CmsCore\Modules\Order\Services\OrderService;
use Rahweb\CmsCore\Modules\Product\Entities\Product;


class OrderController extends Controller
{
    //cart
    public function cart()
    {
        $basket = BasketService::findBasketAndCheckStock();
      if (!isset($basket)){
          return redirect()->route('basket.cart');
      }
        if ($basket->address_id == null){
            return redirect()->route('basket.shipping')->with('error','لطفا ابتدا آدرس را انتخاب کنید');
        }

        $items = $basket ? new BasketCollection(@$basket->items) : [];

        $banks = BankService::findAllActive();
        return view('pages.cart.payment', compact('basket','items','banks'));
    }
    public function addDiscount(Request $request)
    {
        return DiscountService::checkDiscount($request->get('discount_code'));
    }
    public function deleteDiscount(Request $request)
    {
        $basket = BasketService::findBasketAndCheckStock();
        $basket->update([
           'discount_id'=>null
        ]);
    }
    //price
    public function orderPrice(){
        $price = DiscountService::listPrice();
        return response()->json($price);
    }
    //create
    public function create(Request $request){
        if ($request->get('bank_id') == null){
            return redirect()->back()->with('error','درگاه پرداخت مورد نظر خود را انتخاب  کنید');
        }
        $basket = BasketService::findBasketAndCheckStock();
        $basket->update([
           'bank_id'=>@$request->get('bank_id')
        ]);
        $order = OrderService::create($basket);
        return OrderService::checkOut($order);
    }
    public function finishZarinPal(Request $request)
    {
        $input = $request->all();
        $currentOrder = OrderService::findByAuthority($input['Authority']);
        if ($currentOrder == null){
            return redirect(route('basket.cart'))->with('error','فاکتور معتبر نمی باشد');
        }
        return OrderService::finish($currentOrder);

    }
    //endOrder
    public function success($id)
    {
        $order = OrderService::findById($id);
        if ($order->user_id !=  Auth::id()){
            return redirect('/')->with('error','این فاکتور متعلق به شما نیست');

        }
        if ($order->order_status !=  "paid"){
            return redirect('/')->with('info','برای اطلاعات بیشتر با پشتیبانی تماس بگیرید');

        }
        return view('pages.cart.success',compact('order'));


    }
    public function failed()
    {
        return view('pages.cart.failed');


    }

}
