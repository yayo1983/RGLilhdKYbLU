<?php


namespace App\Business;


interface iRequest
{
   public function Transaction($url, $card, $client, $establisment, $pago_facil);

   public function Check($url, $api_credential);
}
