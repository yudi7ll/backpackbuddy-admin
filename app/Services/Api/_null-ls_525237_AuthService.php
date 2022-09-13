<?php

namespace App\Services\Api;

use Auth;
use Carbon\Carbon;

class AuthService
{
    protected $tokenName = 'customer-api';

    /**
     * Create token by given creds
     *
     * @return array
     */
    public function createToken($customer, $rememberMe = false)
    {
        // Login the customer for future request
        Auth::login($customer);

        // get new token
        $tokenResult = $customer->createToken($this->tokenName);
        $token = $tokenResult->token;

        if ($rememberMe) {
            $token->expires_at = now()->addMonth(1);
            $token->save();
        }

        return [
            'access_token' => $tokenResult->accessToken,
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ];
    }
}
