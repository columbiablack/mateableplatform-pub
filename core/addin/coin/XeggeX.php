<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\addin\coin;

class XeggeX
{
    public function getMarketValue(): string
    {
        //USDT price on Xeggex
        $url = 'https://xeggex.com/api/v2/asset/getbyticker/MTBC';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result= curl_exec ($ch);
        curl_close ($ch);
        $info = json_decode($result, true);

        return $info["usdValue"];
    }

    public function getCoinUSDValue($amount): string
    {
        $price = $amount;
        $market = $this->getMarketValue();
        $totalUSD = $price * $market;

        return number_format($totalUSD, 9, '.', '');
    }
}