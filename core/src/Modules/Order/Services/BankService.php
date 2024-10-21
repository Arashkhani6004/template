<?php

namespace Rahweb\CmsCore\Modules\Order\Services;

use Illuminate\Support\Arr;
use Rahweb\CmsCore\Modules\Order\Entities\Bank;
use Rahweb\CmsCore\Modules\Product\DTO\ProductDTO;
use Rahweb\CmsCore\Modules\Product\Entities\Product;


class BankService
{
    public static function findAllActive()
    {
      return Bank::orderBy('id','DESC')->Active()->get();
    }

    public function update(int $id, $input)
    {
        $bank = Bank::findOrfail($id);
        $bank->update([
            'status' => $input['status'] ?? 1,
            'config' => json_encode(Arr::except($input, ['status','_token']))
        ]);


    }
}
