<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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

        if(isset($data['products'])) {
            $items = [];
            foreach($data['products']['product'] as $key => $product) {
                $items[$key] = [
                    'product_id' => $product['pid'],
                    'product_name' => $product['name'],
                    'pricing' => $product['pricing']['IDR'] ?? $product['pricing']['USD'],
                ];
            }

            return view('product', compact('items'));
        }
        
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

    public function checkout($id)
    {
        /**
         * Do this function to show domain registration
         */
        $query = [
            'pid' => $id
        ];

        $product = $this->callWhmcs('getProducts', $query);
        
        $pricing = $product['products']['product'][0]['pricing']['IDR'] ?? $product['products']['product'][0]['pricing']['USD'];
        // dd($pricing);
        $items = [];
        foreach ($pricing as $key => $value ) {
            if(substr($key, -1) == "y") {
                $items[$key] = $value;
            }
        }
        $product['billing_type'] = $items;
        $product['prefix'] = $pricing['prefix'];
        $product['suffix'] = $pricing['suffix'];

        return view('order', compact('product'));
    }

    public function review()
    {
        /**
         * Do this function to show domain registration
         */
        $paymentMethod = $this->callWhmcs('GetPaymentMethods');

        return view('invoices', compact('paymentMethod'));
    }

    public function submitOrder(Request $request)
    {
        /**
         * Do this function to submit order
         */
        $queryClient = [
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'address1' => $request->get('address'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'postcode' => $request->get('postcode'),
            'country' => 'US',
            'phonenumber' => $request->get('phonenumber'),
            'password2' => $request->get('password'),
            'clientip' => $request->get('clientip'),
        ];

        $client = $this->callWhmcs('AddClient', $queryClient);
        
        $clientid = $client['clientid'];
        $queryOrder = [
            'clientid' => $clientid,
            'pid' => $request->get('pid'),
            'domain' => $request->get('domain'),
            'idnlanguage' => 'INA',
            'billingcycle' => $request->get('billing_type'),
            'domaintype' => 'register',
            'paymentmethod' => $request->get('paymentmethod'),
        ];

        $order = $this->callWhmcs('AddOrder', $queryOrder);
        dd($order);
        return redirect('/home');
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
            'username' => getenv('API_IDENTIFIER'),
            'password' => getenv('API_SECRET'),
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
