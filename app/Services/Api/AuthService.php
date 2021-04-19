<?php

namespace App\Services\Api;

use App\Customer;
use Auth;
use Carbon\Carbon;
use Hash;
use Lang;

class AuthService
{
    protected $tokenName = 'customer-api';

    /**
     * Create token by given creds
     *
     * @return array
     */
    public function createToken($customer, $remember = false)
    {
        // Login the customer for future request
        Auth::login($customer);

        // get new token
        $tokenResult = $customer->createToken($this->tokenName);
        $token = $tokenResult->token;

        if ($remember) {
            $token->expires_at = now()->addMonth(1);
            $token->save();
        }

        return [
            'access_token' => $tokenResult->accessToken,
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ];
    }

    /**
     * Check the customer credentials
     *
     * @param array
     * @return mixed|json|model
     */
    public static function checkCreds($creds)
    {
        $customer = Customer::firstWhere('username', $creds['username']);

        if (!$customer || !Hash::check($creds['password'], $customer->password)) {
            return response()->json([
                'message' => Lang::get('auth.failed'),
            ], 401);
        }

        return $customer;
    }
}
