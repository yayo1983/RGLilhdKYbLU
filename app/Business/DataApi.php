<?php

namespace App\Business;

use App\Models\Card;
use App\Models\Client;
use App\Models\Establishment;
use App\Models\PagoFacil;
use App\Models\RequestPagoFacil;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DataApi
{
    private $request;

    public function __construct()
    {
        $this->request = RequestFactory::getRequest("guzzle");
    }

    public function testcurl($api_credential){
        $this->request = RequestFactory::getRequest("curl");
        $response = $this->request->check("/Wsrtransaccion/index/format/json?",$api_credential);
        if($response->{'rest'}->{'status'} = 'failed'){
            $response = 'Error status: Fallido. '.$response->{'rest'}->{'response'} ->{'message'};
        }
        return $response;
    }

    public function doTransaction($api_credential, $request)
    {
        $card = new Card();
        $card->name_card_holder = $request->name;
        $card->last_name_card_holder = $request->last_name;
        $card->card_number = $request->card_number;
        $card->cvt = $request->cvt;
        $card->expiration_month = $request->expiration_month;
        $card->expiration_year = $request->expiration_year;

        $client = new Client();
        $client->cp = $request->cp;
        $client->email = $request->email;
        $client->telephone = $request->telephone;
        $client->cellular = $request->cellular;
        $client->streetnumber = $request->streetnumber;
        $client->suburb = $request->suburb;
        $client->municipality = $request->municipality;
        $client->state = $request->state;
        $client->country = $request->country;

        $establisment = new Establishment();
        $establisment->amount_mxp = $request->amount;
        $establisment->id_user_company  = $api_credential['user_key'];
        $establisment->id_branch_office = $api_credential['branch_key'];
        $establisment->param1 = $request->param1;
        $establisment->param2 = $request->param2;
        $establisment->param3 = $request->param3;
        $establisment->param4 = $request->param4;
        $establisment->param5 = $request->param5;
        $establisment->plan   = $request->plan;
        $establisment->monthly_payments = $request->monthly_payments;
        $establisment->http_user_agent  = $request->header('User-Agent');
        $establisment->ip_server        = $request->header('Host');

        $pago_facil = new PagoFacil();
        $pago_facil->method = $request->method;
        $pago_facil->id_service = $request->id_service;
        $response = -1;
        try {
            DB::beginTransaction();
             $card         ->save();
             $client       ->save();
             $establisment ->save();
             $pago_facil   ->save();

            $transaction = new Transaction();
            $transaction->id_establishment = $establisment->id;
            $transaction->id_card   = $card->id;
            $transaction->id_client = $client->id;
            $transaction->id_pago_facil = $pago_facil->id;
            $transaction->save();
            DB::commit();
            $response = $this->request->Transaction("/Wsrtransaccion/index/format/json?", $card, $client, $establisment, $pago_facil);
            if($response->{'WebServices_Transacciones'}->{'transaccion'}->{'status'} != 'failed'){
                $response = $this->saveCheck($response);
            }
        } catch (ErrorException $e) {
            DB::rollBack();
            $response = 'Error status: ' . $e->getRequest() . " " . $e->getResponse();
        }
        return $this->checkResponse($response);
    }

    public function doTransactionTest($api_credential)
    {
        $this->request = RequestFactory::getRequest("guzzle");
        $response = $this->request->TransactiontTest("/Wsrtransaccion/index/format/json?",$api_credential);
       return $this->checkResponse($response);
    }

    private function checkResponse($response)
    {
        if (is_object($response) == false) {
            $response = -1;
        }
        return $response;
    }

    public function checkTransaction($api_credential)
    {
        $response = $this->request->Check("/Wsrtransaccion/index/format/json?", $api_credential);
        $response = $this->saveCheck($response);
        $response = $this->checkResponse($response);
        return $response;

    }

    private function saveCheck($response)
    {
        if (is_object($response)) {
            try {
                $request_pago_facil = new RequestPagoFacil();
                $data = $response->{'WebServices_Transacciones'}->{'transaccion'};
                $error = "";
                foreach ($data->{'error'} as $value){
                   $error = $error." ".$value;
                }
                $data1 = "";
                foreach ($data->{'data'} as $value){
                    $data1 = $data1." ".$value;
                }
                $dataVal = "";
                foreach ($data->{'dataVal'}as $value){
                    $dataVal= $dataVal." ".$value;
                }
                $request_pago_facil->autorizado   = $data->{'autorizado'};
                if($data->{'autorizacion'} == "n/a"){ $request_pago_facil->autorizacion = null;} else {$request_pago_facil->autorizacion = $data->{'autorizacion'};}
                $request_pago_facil->transaccion  = $data->{'transaccion'};
                $request_pago_facil->texto        = $data->{'texto'};
                $request_pago_facil->error        = $error;
                $request_pago_facil->empresa      = $data->{'empresa'};
                $request_pago_facil->transIni     = date("Y-m-d H:i:s", strtotime($data->{'TransIni'}));
                $request_pago_facil->transFin     = date("Y-m-d H:i:s", strtotime($data->{'TransFin'}));
                $request_pago_facil->TipoTC       = $data->{'TipoTC'};
                $request_pago_facil->data         = $data1;
                $request_pago_facil->dataVal      = $dataVal;
                $request_pago_facil->pf_message   = $data->{'pf_message'};
                $request_pago_facil->status       = $data->{'status'};
                DB::beginTransaction();
                $request_pago_facil->save();
                DB::commit();
            } catch (ErrorException $e) {
                DB::rollBack();
                $response = 'Error status: ' . $e->getRequest() . " " . $e->getResponse();
            }
        }
        return $response;
    }
}
