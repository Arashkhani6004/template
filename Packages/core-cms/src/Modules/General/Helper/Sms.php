<?php

namespace Rahweb\CmsCore\Modules\General\Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Setting\Entities\Setting;

class Sms
{
    private $token;
    private $baseUrl = "https://api.kavenegar.com/v1";
    public function __construct()
    {
        $kave = Setting::where('key', 'kavenegar_key')->whereNotNull('value')->first();
        $this->token = $kave ? $kave['value'] : null;
    }
    public function execute(string $url)
    {
        if (!isset($this->token)){
            return Redirect::back()
                ->with('error', 'لطفا با پشتیبانی تماس بگیرید ');
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->baseUrl/$this->token/$url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER => 0,  // اضافه کردن این خط
            CURLOPT_SSL_VERIFYHOST => 0   // اضافه کردن این خط
        ));
        $response = curl_exec($curl);

        // افزودن لاگ برای دیباگ بهتر
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            Log::error("cURL error ({$error_msg}) during request to {$url}");
        }

        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_status != 200) {
            Log::error("HTTP status {$http_status} received from {$url}");
        }

        curl_close($curl);

        if ($response === false) {
            Log::error("Failed to get response from {$url}");
            return false;
        }

        return $response;
    }



    public function sendLookup(string $template, array $tokens, string $mobile, string $type = "sms")
    {
        $tokens_query = http_build_query($tokens);
        $url = "verify/lookup.json?receptor=$mobile&type=$type&template=$template&$tokens_query";
        try {
            return $this->execute($url);
        } catch (\Exception $e) {
            Log::info($e);
            return false;
        }
    }

    public function sendSms(string $text, string $mobile)
    {
        $message = urlencode($text);
        if (env("APP_ENV") == "local") {
            $receptor = "09032783528";
        } else {
            $receptor = $mobile;
        }
        $url = "sms/send.json?receptor=$receptor&message=$message&sender=1000660006600";
        try {
            $res = $this->execute($url);
            $res_json = json_decode($res);
            if (isset($res_json->return) && $res_json->return->status == 200) {
                return ["success" => true];
            } else {
                $error_message = isset($res_json->return->message) ? $res_json->return->message : 'Unknown error';
                return ["success" => false, "message" => $error_message];
            }
        } catch (\Exception $e) {
            Log::error("Exception during sending SMS: " . $e->getMessage());
            return ["success" => false, "message" => $e->getMessage()];
        }
    }


    public function sendSmsArray(array $messages)
    {
        $sender = [];
        $message = [];
        $receptor = [];
        foreach ($messages as $row) {
            if (env("APP_ENV") == "local") {
                $receptor[] = "09914646805";
            } else {
                $receptor[] = $row["receptor"];
            }
            $message[] = $row["message"];
            $sender[] = "1000660006600";
        }
        try {
            $api = new KavenegarApi($this->token);
            $api->SendArray($sender, $receptor, $message);
            return ["success" => true];
        } catch (ApiException $e) {
            return ["success" => false, "message" => $e->errorMessage()];
        } catch (HttpException $e) {
            return ["success" => false, "message" => $e->errorMessage()];
        }
    }
}
