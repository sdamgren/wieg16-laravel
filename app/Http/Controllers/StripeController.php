<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Plan;
use Stripe\Subscription;


class StripeController extends Controller
{
    public function index() {
        return view('stripe/index');

    }
    public function checkout(Request $request) {
        $input = $request->input();

        Stripe::setApiKey("sk_test_kPJl8EKdg9pT6gOTmunAiRdg");

        /*
        $charge = Charge::create([
            "amount" => 999,
            "currency" => "sek",
            "source" => $input['stripeToken'],
            "description" => "Charge for".$input['stripeEmail']
        ]);*/

        $charge = Charge::retrieve('ch_1BWKdAEi2EvaH9VaGR255cbf');
        $charge = Charge::All(); //Tar med alla transaktioner, kan göra på detta sättet eller med id
        dd($charge);
    }

    public function subscription() {
        Stripe::setApiKey("sk_test_kPJl8EKdg9pT6gOTmunAiRdg");
/*
        $plan = Plan::create([
            "name" => "Basic Free Plan",
            "id" => "basic-monthly-free",
            "interval" => "month",
           // "interval_count" => 3,
            "currency" => "sek",
            "amount" => 0,

        ]); */
        //$plan = Plan::retrieve('basic-monthly-free');
        $customer = Customer::create([
            "email" => "sandra.damgren@hotmail.com",
        ]);
        /*
        $customer = Customer::create([
           "email" => "sandra.damgren@hotmail.com",
        ]);
        */

        $sub = Subscription::create([
            "customer" => $customer->id,
            "items" => [
                [
                    "plan" => "basic-monthly-free",
                ],
            ]
        ]);

        dd($sub);
    }
}
