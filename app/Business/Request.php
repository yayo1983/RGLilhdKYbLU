<?php


namespace App\Business;


class Request implements iRequest
{

    public function __construct()
    {

    }

    public function Transaction($url, $card, $client, $establisment, $pago_facil)
    {
        // TODO: Implement Transaction() method.
    }

    public function Check($url, $api_credential)
    {
        // TODO: Implement Check() method.
    }
}
