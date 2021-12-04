<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaypalService; 
/* use App\Resolvers\PaymentPlatformResolver; */

class PaymentController extends Controller
{
    

    public function pay(Request $request){

        $rules = [
            /* 'value' => ['required', 'numeric', 'min:5'], */
            'payment_platform' => 'required', 'exist:payment_platform,id',
        ];

        $request->validate($rules);
    

        $paymentPlatform = resolve(PaypalService::class);
        
       
        return $paymentPlatform->handlePayment($request);

    }


    public function approval()
    {
        

         $paymentPlatform = resolve(PaypalService::class);
      
        
        return $paymentPlatform->handleApproval();

    }

    public function cancelled()
    {
         return redirect('home')
            ->withErrors('You cancelled the payment'); 
    } 

}
