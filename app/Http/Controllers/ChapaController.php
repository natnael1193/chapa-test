<?php

namespace App\Http\Controllers;

use App\Models\ChapaTest;
use Illuminate\Http\Request;
use Chapa\Chapa\Facades\Chapa as Chapa;

class ChapaController extends Controller
{
    /**
     * Initialize Rave payment process
     * @return void
     */
    protected $reference;

    public function __construct()
    {
        $this->reference = Chapa::generateReference();
    }
    public function initialize()
    {
        // return response()->json([
        //     "message" => "Payment Successfull"
        // ]);
        //This generates a payment reference
        $reference = $this->reference;


        // Enter the details of the payment
        $data = [

            'amount' => 10,
            'email' => 'hi@negade.com',
            'tx_ref' => $reference,
            'currency' => "ETB",
            'callback_url' => route('callback', [$reference]),
            'first_name' => "Israel",
            'last_name' => "Goytom",
            "customization" => [
                "title" => 'Chapa Laravel',
                "description" => "I amma testing this"
            ]
        ];


        return  $payment = Chapa::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return response()->json([
                "message" => "Payment not Successfull",
                "status" => $payment['status']
            ]);
        }
        return response()->json([
            "message" => "Payment Successfule",
            "url" => $payment['data']['checkout_url']
        ]);
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback($reference)
    {

        $data = Chapa::verifyTransaction($reference);
        dd($data);

        //if payment is successful
        if ($data['status'] ==  'success') {
            ChapaTest::create([
                "name" => "paid"
            ]);

            dd($data);
        } else {
            //oopsie something ain't right.
        }
    }
}