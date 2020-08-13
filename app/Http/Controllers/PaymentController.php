<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business\DataApi;
use Illuminate\Support\Facades\Config;
use App;

class PaymentController extends Controller
{
    protected $data;
    protected $api_credential;

    public function __construct(DataApi $data)
    {
        $this->api_credential = Config::get("credencialesapirest");
        $this->data = $data;
        //$this->defineLanguage();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'             => 'required|string|max:50',
            'last_name'        => 'required|string|max:50',
            'card_number'      => 'required|string|max:16',
            'cvt'              => 'required|integer|digits_between:3,4',
            'cp'               => 'required|string|max:50',
            'expiration_month' => 'required|integer|digits_between:1,2',
            'expiration_year'  => 'required|integer|digits_between:1,2',
            'amount'           => 'required|numeric',
            'id_branch_office' => 'required|not_in:-1',
            'id_service'       => 'required|not_in:-1',
            'email'            => 'required|email|max:200',
            'telephone'        => 'required|string|max:10',
            'cellular'         => 'required|string|max:10',
            'streetnumber'     => 'required|string|max:45',
            'suburb'           => 'required|string|max:30',
            'municipality'     => 'required|string|max:30',
            'state'            => 'required|string|max:30',
            'country'          => 'required|string|max:50',
            'param1'           => 'nullable|string|max:60',
            'param2'           => 'nullable|string|max:60',
            'param3'           => 'nullable|string|max:60',
            'param4'           => 'nullable|string|max:60',
            'param5'           => 'nullable|string|max:60',
            'monthly_payments' => 'nullable|string|max:2',
        ]);
        $data = $this->data->doTransaction($this->api_credential, $request);
        return redirect()->route('payment.show', compact("data"));
    }

    /**
     * Display check the transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = $this->data->checkTransaction($this->api_credential);
        return view('Payment.show', compact("data"));
    }

    /*public function defineLanguage()
    {
        $locale = "es";
        if (session()->exists('locale')) {
            $locale = session('locale');
            App::setLocale($locale);
        } else {
            $locale = App::getLocale();
        }
        return $locale;
    }*/
}
