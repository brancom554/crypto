<?php

namespace App\Http\Controllers\Gateway\paypal_sdk;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\paypal_sdk\PayPalCheckoutSdk\Core\PayPalHttpClient;
use App\Http\Controllers\Gateway\paypal_sdk\PayPalCheckoutSdk\Core\SandboxEnvironment;
use Illuminate\Http\Request;


class ProcessController extends Controller
{
	/*
     * Paypal Gateway
     */
    public static function process($deposit)
    {
    	$credentials = json_decode($deposit->gateway_currency()->gateway_parameter);
    	$environment = new SandboxEnvironment($credentials->clientId, $credentials->clientSecret);
		$client = new PayPalHttpClient($environment);
    	dd($client);
    }
}