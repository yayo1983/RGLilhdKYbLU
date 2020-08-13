<?php


namespace App\Business;


use League\CommonMark\Util\UrlEncoder;

class CurlAPI
{
    public function __construct()
    {
    }

    public function request($api_credential)
    {
        //API URL
        $url = 'https://sandbox.pagofacil.tech/Wsrtransaccion/index/format/json?';

        //create a new cURL resource
        $ch = curl_init($url);

         //setup request to send json via POST

        /*$data = array(
            'method' => $pago_facil->method,
            'data' => [
                'nombre' => $card->name_card_holder,
                'apellidos' => $card->last_name_card_holder,
                'numeroTarjeta' => $card->card_number,
                'cvt' => $card->cvt,
                'cp' => $client->cp,
                'mesExpiracion' => $card->expiration_month,
                'anyoExpiracion' => $card->expiration_year,
                'monto' => $establisment->amount_mxp,
                'idSucursal' => $api_credential['branch_key'],
                'idUsuario' => $api_credential['user_key'],
                'idServicio' => $pago_facil->id_service,
                'email' => $client->email,
                'telefono' => $client->telephone,
                'celular' => $client->cellular,
                'calleyNumero' => $client->streetnumber,
                'colonia' => $client->suburb,
                'municipio' => $client->municipality,
                'estado' => $client->state,
                'pais' => $client->country,
                'idPedido' => 'TEST_TX', // $establisment->id
                'param1' => $establisment->param1,
                'param2' => $establisment->param2,
                'param3' => $establisment->param3,
                'param4' => $establisment->param4,
                'param5' => $establisment->param5,
                'httpUserAgent' => $establisment->http_user_agent,
                'ip' => $establisment->ip_server
            ]);*/
        $data = array(
            'method' => "transaccion",
            'data' => [
                'nombre' => 'Jon',
                'apellidos' => 'Snow',
                'numeroTarjeta' => "5513 5509 9409 2123",
                'cvt' => "271",
                'cp' => "48219",
                'mesExpiracion' => "08",
                'anyoExpiracion' => "22",
                'monto' => "1599",
                'idSucursal' => $api_credential['branch_key'],
                'idUsuario' => $api_credential['user_key'],
                'idServicio' => "3",
                'email' => "pruebas@pagofacil.net",
                'telefono' => "55751875",
                'celular' => "5530996234",
                'calleyNumero' => "Valle del Don",
                'colonia' => "Del Valle",
                'municipio' => "Tecamac",
                'estado' => "Sonora",
                'pais' => "México",
                'idPedido' => 'TEST_TX', // $establisment->id
                'param1' => '',
                'param2' => '',
                'param3' => '',
                'param4' => '',
                'param5' => '',
                'httpUserAgent' => "Mozilla/5.0 (X11; Fedora; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0",
                'ip' => "1.1.1.1"
            ]);

        $payload = json_encode(array("data" => $data));
        //$payload = urlencode (serialize($data)) ;

        //attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        //set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        //return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute the POST request
        $result = curl_exec($ch);
         //close cURL resource
        curl_close($ch);
        return json_decode($result);
    }
}
