<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Do this function to show order page
         */
        $data = $this->callWhmcs('getProducts');

        return view('product', compact('data'));
    }

    public function domainRegister()
    {
        /**
         * Do this function to show domain registration
         */
        return view('domain');
    }

    public function checkDomainAjax($domain)
    {
        /**
         * Do this function to check domain available or not
         */
        $query = [
            'domain' => $domain
        ];

        $data = $this->callWhmcs('DomainWhois', $query);

        return $data;
    }

    function callWhmcs($action, $params=null) {
        /**
         * Do this function to request data to WHMCS.
         * 
         * Args
         *  action
         *  params
         * 
         * Returns
         *  data from WHMCS
         */
        $url = getenv('WHMCS_URL');
        $query = [
            'username' => 'Q7TjVTPuasaCmlNSg1h1LrnfXQqDbCG0',
            'password' => 'bn5J0OqM2fpf6AXcJSZfqUbukeaXdxti',
            'action' => $action,
            'responsetype' => 'json',
        ]; 

        if($params) {
            $query = array_merge($params, $query);
        }
        
        $queryParams = "";
        foreach($query as $key => $item) {
            if($queryParams == "") {
                $queryParams = $queryParams . "?" . $key . "=" . $item;
            } else {
                $queryParams = $queryParams . "&" . $key . "=" . $item;
            }
        }

        $response = Http::post($url . $queryParams);
        return $response->json();
    }
}
