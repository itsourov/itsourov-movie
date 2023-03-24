<?php

namespace App\Http\Controllers;

use App\Models\BkashTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BkashController extends Controller
{

    public function token()
    {
        if (Session::get('id_token')) {
            return Session::get('id_token');
        } else {
            return $this->refresh_token();
        }
    }
    public function refresh_token()
    {





        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'password' => config('services.bkash.password'),
            'username' => config('services.bkash.username'),
        ])->post(config('services.bkash.tokenURL'), [
            'app_key' => config('services.bkash.app_key'),
            'app_secret' => config('services.bkash.app_secret'),
        ]);

        if ($response->json('id_token')) {
            Session::put('id_token', $response->json('id_token'));
            return $response->json('id_token');
        } else {
            Session::forget('id_token');
            return 'error';
        }
    }

    public function create_payment(Request $request)
    {
        $amount = $request->amount;
        $invoice = "46f647h7"; // must be unique
        $intent = "sale";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'authorization' => $this->token(),
            'x-app-key' => config('services.bkash.app_key'),
        ])->post(config('services.bkash.createURL'), [
            'amount' => $amount,
            'currency' => 'BDT',
            'merchantInvoiceNumber' => $invoice,
            'intent' => $intent
        ]);

        return $response;
    }
    public function execute_payment(Request $request)
    {
        $paymentID = $request->paymentID;


        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'authorization' => $this->token(),
            'x-app-key' => config('services.bkash.app_key'),
        ])->post(config('services.bkash.executeURL') . $paymentID);


        if ($response->json('paymentID')) {
            $bkashTransaction = new BkashTransaction();
            foreach ($response->json() as $key => $value) {
                $bkashTransaction->$key = $value;
            }
            $bkashTransaction->save();
        }
        return $response;
    }
}
