<?php


namespace App\Business;

use GuzzleHttp\Client;

class RequestFactory
{
    /**
     * RequestFactory constructor.
     */
    public function __construct()
    {

    }

    public static function getRequest($typerequest)
    {
        $request= new Request();
        switch($typerequest){
            case 'guzzle':
                $client = new Client(
                    [
                        'base_uri' => 'https://sandbox.pagofacil.tech',
                        'timeout'  => 2.0
                    ]
                );
                return new GuzzleHttpRequest($request, $client);
                break;
            case 'curl':
                return new CurlAPI();
                break;
            default:
                throw new InvalidArgumentException('Tipo de dato no válido');
                break;
        }
    }
}
