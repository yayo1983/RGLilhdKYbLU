<?php


namespace App\Business;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\InvalidArgumentException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;

class GuzzleHttpRequest extends RequestAbstract
{
    public function __construct(iRequest $request,Client $client)
    {
        $this->client = $client;
    }

    public function Transaction($url, $card, $client, $establisment, $pago_facil)
    {
        $IP = explode(":", $establisment->ip_server);
        $data = "method="               . $pago_facil->method."&
                 data[nombre]="         . $card->name_card_holder."&
                 data[apellidos]="      . $card->last_name_card_holder."&
                 data[numeroTarjeta]="  . $card->card_number."&
                 data[cvt]="            . $card->cvt."&
                 data[cp]="             . $client->cp."&
                 data[mesExpiracion]="  . $card->expiration_month."&
                 data[anyoExpiracion]=" . $card->expiration_year."&
                 data[monto]="          . $establisment->amount_mxp."&
                 data[idSucursal]="     . $establisment->id_branch_office."&
                 data[idUsuario]="      . $establisment->id_user_company."&
                 data[idServicio]="     . $pago_facil->id_service."&
                 data[email]="          . $client->email."&
                 data[telefono]="       . $client->telephone."&
                 data[celular]="        . $client->cellular."&
                 data[calleyNumero]="   . $client->streetnumber."&
                 data[colonia]="        . $client->suburb."&
                 data[municipio]="      . $client->municipality."&
                 data[estado]="         . $client->state."&
                 data[pais]="           . $client->country."&
                 data[idPedido]=TEST_TX&
                 data[param1]="         . $establisment->param1."&
                 data[param2]="         . $establisment->param2."&
                 data[param3]="         . $establisment->param3."&
                 data[param4]="         . $establisment->param4."&
                 data[param5]="         . $establisment->param5."&
                 data[httpUserAgent]="  . $establisment->http_user_agent."&
                 data[ip]="             . $IP[0];
        return $this->callGuzzleClient($url, $data);
    }


    public function TransactiontTest($url,$api_credential)
    {
        $data =
            array ('method' => "transaccion"
            /*    ,
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
            ]*/
            );
        return $this->callGuzzleClientTest($url, $data);
    }

    /** public function TransactionOtra($url, $card, $client, $establisment, $pago_facil)
     * {
     * $response = $this->client->request('POST', $url, [
     * 'method' => $pago_facil->method,
     * 'data' => [
     * 'nombre' => $card->name_card_holder,
     * 'apellidos' => $card->last_name_card_holder,
     * 'numeroTarjeta' => $card->card_number,
     * 'cvt' => $card->cvt,
     * 'cp' => $client->cp,
     * 'mesExpiracion' => $card->expiration_month,
     * 'anyoExpiracion' => $card->expiration_year,
     * 'monto' => $establisment->amount_mxp,
     * 'idSucursal' => $establisment->id_branch_office,
     * 'idUsuario' => $establisment->id_user_company,
     * 'idServicio' => $pago_facil->id_service,
     * 'email' => $client->email,
     * 'telefono' => $client->telephone,
     * 'celular' => $client->cellular,
     * 'calleyNumero' => $client->streetnumber,
     * 'colonia' => $client->suburb,
     * 'municipio' => $client->municipality,
     * 'estado' => $client->state,
     * 'pais' => $client->country,
     * 'idPedido' => 'TEST_TX', // $establisment->id
     * 'param1' => $establisment->param1,
     * 'param2' => $establisment->param2,
     * 'param3' => $establisment->param3,
     * 'param4' => $establisment->param4,
     * 'param5' => $establisment->param5,
     * 'httpUserAgent' => $establisment->http_user_agent,
     * 'ip' => $establisment->ip_server
     * ]
     * ]);
     * return json_decode($response->getBody()->getContents());
     * }*/

    public function Check($url, $api_credential)
    {
        $data = "method=transaccion&data[idPedido]=TEST_TX&
                 data[idSucursal]=".$api_credential['branch_key']."&
                 data[idUsuario]=".$api_credential['user_key'];
        return $this->callGuzzleClient($url, $data);
    }

    private function callGuzzleClient($url, $data)
    {
        try {
            $response = $this->client->post($url.$data);
        } catch (ClientException|ServerException|BadResponseException|ConnectException|GuzzleException|
        InvalidArgumentException|RequestException|TransferException|Exception $e) {
            return 'Error status: ' .$e->getRequest() . " " . $e->getResponse();
        }
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        } else {
            return 'Error status: ' . $response->getStatusCode() . ' ' . $response->getReasonPhrase();
        }
    }

    private function callGuzzleClientTest($url, $data)
    {
        try {
            $response = $this->client->request('POST', $url, [
                'method' => "transaccion",
                'data'   => [
                    'nombre'    => 'Jon',
                    'apellidos' => 'Snow',
                    'numeroTarjeta' => "5513 5509 9409 2123",
                    'cvt' => "271",
                    'cp' => "48219",
                    'mesExpiracion' => "08",
                    'anyoExpiracion' => "22",
                    'monto' => "1599",
                    'idSucursal' => "560d73f2a001c6d40dd805ab9ccafdeabf37cec3",
                    'idUsuario' => "a2bce1f48cf7d11fae7d662d8bf7513355adf96f",
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
                ]]);
        } catch (ClientException|ServerException|BadResponseException|ConnectException|GuzzleException|
        InvalidArgumentException|RequestException|TransferException|Exception $e) {
            return 'Error status: ' .$e->getRequest() . " " . $e->getResponse();
        }
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        } else {
            return 'Error status: ' . $response->getStatusCode() . ' ' . $response->getReasonPhrase();
        }
    }
}
