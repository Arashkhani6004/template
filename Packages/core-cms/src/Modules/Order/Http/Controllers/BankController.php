<?php

namespace Rahweb\CmsCore\Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Rahweb\CmsCore\Modules\Order\Entities\Bank;
use Rahweb\CmsCore\Modules\Order\Services\BankService;


class BankController extends Controller
{
    protected $bankService;

    public function __construct(BankService $bankService)
    {
        $this->bankService = $bankService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $query = Bank::query();
        $banks = $query->orderby('id', 'DESC')->paginate(20);
        return view('CmsCore::order.bank.index', compact('banks'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = Bank::findOrfail($id);
        $bank_fields = Config::get('order.my_banks')[$data->bank_type];
        return view('CmsCore::order.bank.edit',
            compact('data','bank_fields'));

    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->bankService->update($id,$input);
        return redirect()->route('admin.bank.index')
            ->with('success', 'درگاه ویرایش شد.');
    }

}
