<?php

namespace Rahweb\CmsCore\Modules\Order\Library;

use App\Library\SiteHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class ZarinPalClass
{

    public  function execute($merchant,$price)
    {
        $site_name = @SiteHelper::getInformation()['site_name'];
        $description = $site_name.' خرید از ';
        $data = array(
            'MerchantID' => $merchant,
            'Amount' => $price,
            'CallbackURL' => route('basket.finish.zarin-pal'),
            'Description' => $description
        );
        $jsonData = json_encode($data);

        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        if ($err){
            return [
                'status'=>'failed'
            ];
        }
        $result = json_decode($result, true);
        if (@$result["Status"] != 100){
            return [
                'status'=>'failed'
            ];
        }
        if ($result["Status"] == 100){
            return [
                'status'=>'success',
                'Authority'=>$result['Authority']
            ];
        }
        curl_close($ch);

    }
    public function finish($merchant,$authority,$price){
        $data = array('MerchantID' => $merchant,
            'Authority' => $authority,
            'Amount' => $price);
        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        if ($err){
            return [
                'status'=>'failed',

            ];
        }
        if ($result["Status"] == 100 || $result["Status"] == 101){
            $inventory = $result["Status"] == 100 ? true : false;
            return [
                'status'=>'success',
                'inventory'=>$inventory,
                'RefID'=>$result['RefID']
            ];
        }
        else{
            return [
                'status'=>'failed',

            ];
        }

        curl_close($ch);
    }
}
