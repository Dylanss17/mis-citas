<?php

namespace App\Services;

use Illuminate\Http\Request; 
use App\Http\Traits\ConsumesExternalServices;
/* use App\Services\CurrencyConversionService;
use App\Appointment; */
use Session; 
use App\Appointment;
use DB;
/* use App\Order;
use App\Client; */
/* use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Mail; 
use App\MAil\sendMail; */



class PaypalService
{
    use ConsumesExternalServices;

    protected $baseUri;

    protected $clientId;

    protected $clientSecret;

/*      protected $converter;  */

    public function __construct( CurrencyConversionService $converter )
    {
        $this->baseUri = config('services.paypal.base_uri');
        $this->clientId = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');

        /* $this->converter = $converter; */

    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }   

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {   
        $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");

        return "Basic {$credentials}";
    }

    public function handlePayment(Request $request)
    {
        $order = $this->createOrder($request->value);

        $orderLinks = collect($order->links);

        $approve = $orderLinks->where('rel', 'approve')->first();

        $orderId = $order->id;

        Appointment::createForPatient($request, auth()->id(), $orderId);

        session()->put('approvalId', $order->id);
      /*   Appointment::createForPatient($request, auth()->id()); */
       /*  return $paymentPlatform->handlePayment($request);  */
        

        return redirect($approve->href);
    }

    public function handleApproval()
    {
        if (session()->has('approvalId')){
            $approvalId = session()->get('approvalId');
            $payment = $this->capturePayment($approvalId);

            $name = $payment->payer->name->given_name;
          /*   $id = $payment->id; */
            $payment = $payment->purchase_units[0]->payments->captures[0]->amount;
            $amount = $payment->value;
            $currency = $payment->currency_code;

          /*    $id = auth()->user()->id; */
        /*     $citas = Appointment::where('patient_id', $id)->first();  */

          /*   $appointment= \DB::table('appointments');   */
            // $id = \DB::table('appointments')->latest('id')->first();
            // $query = Appointment::select('id')->first();
            // $id_ultimo_registro = $query->id;
            // \DB::table('appointments')
            // ->where('id',$id_ultimo_registro)
            // ->update(['status_pay' => 'Completado']);
           
          /*   $citas->status_pay='Completado';
            $citas->save(); */

            Appointment::where('order_id', $approvalId)->first()
            ->update([
                'status_pay' => 'Completado'
            ]);

            return redirect()
            ->route('appointments')
            ->withSuccess(['payment' => "thanks, {name}. We received your {$amount}{$currency} payment"]);
        }
        return redirect()
            ->route('appointments')
            ->withErrors('We cannot capture your payment.Try again,please');

    } 

    public function createOrder($value)
    {
        
        $value = '12.30';

        return $this->makeRequest(
            'POST',
            '/v2/checkout/orders',
            [],
            [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    0 => [
                        'amount' => [
                            'currency_code' => "USD",
                             'value' => $value, 
                            /* 'value' => '50.00', */
                        ]
                    ]
                ],
                'application_context' => [
                    'brand_name' => config('app.name'),
                    'shipping_preference' => 'NO_SHIPPING',
                    'user_action' => 'PAY_NOW',
                    'return_url' => route('approval'),
                    'cancel_url' => route('cancelled'),
                ]
            ],
            [],
            $isJsonRequest = true,
        );
    }

    public function capturePayment($approvalId)
    {   
        return $this->makeRequest(
            'POST',
            "/v2/checkout/orders/{$approvalId}/capture",
            [],
            [],
            [   
                'Content-Type' => 'application/json',
            ],
        );
    }
/*     public function resolveFactor($currency) 
    {
        return $this->converter->convertCurrency($currency, "USD");
    } 
 */

/* 
    public function handlePayment(Request $request)
    {   
        $order = $this->createOrder($request->value);

        $orderLinks = collect($order->links);

        $approve = $orderLinks->where('rel', 'approve')->first();

        session()->put('approvalId', $order->id);

        return redirect($approve->href);
    }

    public function handleApproval()
    {
        if(session()->has('approvalId')) {
            $approvalId = session()->get('approvalId');

            $payment = $this->capturePayment($approvalId);

            $id = $payment->id;
            $name = $payment->payer->name->given_name;

            $address1 = $payment->purchase_units[0]->shipping->address->address_line_1;
            //$address2 = $payment->purchase_units[0]->shipping->address->address_line_2;
            $area_2 = $payment->purchase_units[0]->shipping->address->admin_area_2;
            $area_1 = $payment->purchase_units[0]->shipping->address->admin_area_1;
            $postcode = $payment->purchase_units[0]->shipping->address->postal_code;
            $countcode = $payment->purchase_units[0]->shipping->address->country_code;

            $payment = $payment->purchase_units[0]->payments->captures[0]->amount;
            $amount = $payment->value;
            $currency = $payment->currency_code;

            $oldCart = Session::has('cart')? Session::get('cart'):null;
            $cart = new Cart($oldCart);
            
            $order = new Order();

            $order->name = $name;
            $order->address = "$address1 "."$area_2 "."$area_1 "."$postcode "."$countcode ";
            $order->cart = serialize($cart);
            $order->payment_id = $id;
            $order->payment_gateway = "Paypal";

            $order->save();
            $orders = Order::where('payment_id', $id)->get();
    
    
            $orders->transform(function($order, $key){
                $order->cart = unserialize($order->cart);
    
                return $order;
                });

            $email = Session::get('client')->email;
    
            Mail::to($email)->send(new SendMail($orders));
            
            Session::forget('home');
            return redirect('/appointments/create')->with('success', ['payment' => "Thanks, {$name}. We received your {$amount}{$currency} payment"]);
        }

        return redirect('/appointments/create')
            ->with('We cannot capture payment. Try again, please');
    }

    public function createOrder($value)
    {   

        if(!Session::has('/appointments/create')){
            return redirect::to('/appointments/create'); 
            // , ['Products' => null]           
        }

        $oldCart = Session::has('/appointments/create')? Session::get('/appointments/create'):null;
        $cart = new Cart($oldCart);

        $value = $cart->totalPrice;

        return $this->makeRequest(
            'POST',
            '/v2/checkout/orders',
            [],
            [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    0 => [
                        'amount' => [
                            'currency_code' => "USD",
                            'value' => round($value * $this->resolveFactor("PEN"), 2) ,
                        ]
                    ]
                ],
                 'application_context' => [
                     'brand_name' => config('app.name'),
                     'shipping_preference' => 'GET_FROM_FILE',
                     'user_action' => 'PAY_NOW',
                     'return_url' => route('approval'),
                     'cancel_url' => route('cancelled'),
                 ]
            ],
            [],
            $isJsonResquest = true,
        );
    }

    public function capturePayment($approvalId)
    {   
        return $this->makeRequest(
            'POST',
            "/v2/checkout/orders/{$approvalId}/capture",
            [],
            [],
            [   
                'Content-Type' => 'application/json',
            ],
        );
    }

    public function resolveFactor($currency) 
    {
        return $this->converter->convertCurrency($currency, "USD");
    } */

}