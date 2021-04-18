<?php

namespace App\Services\Api;

use Auth;
use Carbon\Carbon;

class AuthService
{
    /**
     * Create token by given creds
     *
     * @return object
     */
    public static function createToken($customer, $remember = false)
    {
        // Login the customer for future request
        Auth::login($customer);

        // get new token
        $tokenResult = $customer->createToken('customer-api');
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
}
