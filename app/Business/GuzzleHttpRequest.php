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

class GuzzleHttpRequest
{
    protected $client;

    public function __construct(Client $client)
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

    /**   public function TransactionOtra($url, $card, $client, $establisment, $pago_facil)
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
                 data[idSucursal]=". $api_credential['branch_key'] . "&
                 data[idUsuario]=". $api_credential['user_key'];
        return $this->callGuzzleClient($url, $data);
    }

    private function callGuzzleClient($url, $data)
    {
        try {
            $response = $this->client->post($url.$data);
        }
        catch (ClientException|ServerException|BadResponseException|ConnectException|GuzzleException|
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
