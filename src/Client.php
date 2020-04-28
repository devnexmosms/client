<?php

namespace Nexmosms;

use Nexmosms\Client\Credentials\Basic;

class Client
{
    const BASE_API  = 'https://rest.nexmosms.com';
    protected $credentials = [];

    public function __construct(Basic $basic) {
        //
        $this->credentials["apikey"] = $basic->apikey;
        $this->credentials["apisecret"] = $basic->apisecret;
        $this->apiUrl = static::BASE_API;
    }

    public function send($arrPesan = [])
    {
        //cek $arrPesan
        if ($arrPesan["to"]=="" or $arrPesan["from"]=="" or $arrPesan["text"]=="")
        {
            $response['messages'][0]['status'] = 2;
            return $response;
        }

        $curl = curl_init();
        $url = $this->apiUrl. "/sms/json";

        $arrPOST = [
            "api_key"=>$this->credentials["apikey"],
            "api_secret"=>$this->credentials["apisecret"],
            "to"=>$arrPesan["to"],
            "from"=>$arrPesan["from"],
            "text"=>$arrPesan["text"]
        ];

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($arrPOST));
        $result = curl_exec($curl);

        curl_close($curl);
        return json_decode($result, true);
    }
}

?>