<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacebookController extends Controller
{

    // Method to send Get request to url
    private function doCurl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $data;
    }

    public function index(Request $request) {
        $code = $request->input('code');
        $this->accountKitLogin($code);
        return response()->json($data);
    }

    public function accountKitLogin($code)
    {

        // Initialize variables
        $app_id = '132770820725643';
        $secret = '5fbaa3e3be0c7c67e018c9870b33682a';
        $version = 'v1.2'; // 'v1.1' for example


        // Exchange authorization code for access token
        $token_exchange_url = 'https://graph.accountkit.com/' . $version . '/access_token?' .
            'grant_type=authorization_code' .
            '&code=' . $code .
            "&access_token=AA|$app_id|$secret";
        $data = $this->doCurl($token_exchange_url);

        if (!isset($data['id'])) dd($data);
        $user_id = $data['id'];
        $user_access_token = $data['access_token'];
        $refresh_interval = $data['token_refresh_interval_sec'];

        // Get Account Kit information
        $me_endpoint_url = 'https://graph.accountkit.com/' . $version . '/me?' .
            'access_token=' . $user_access_token;
        $data = $this->doCurl($me_endpoint_url);
        $phone = isset($data['phone']) ? $data['phone']['number'] : '';
        $email = isset($data['email']) ? $data['email']['address'] : '';
        return $data;
    }

 /*   public function loginForm() {
        return view('login');
    }*/
}

