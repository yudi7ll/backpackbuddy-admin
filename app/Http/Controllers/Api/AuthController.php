<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Auth;
use Carbon\Carbon;
use Hash;

class AuthController extends Controller
{
    protected $tokenName = 'customer-api';

    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Register customer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $this->data = $request->all();
        $this->data['password'] = bcrypt($this->data['password']);

        $newCustomer = $this->customer->create($this->data);

        return response()->json($newCustomer, 200);
    }

    /**
     * Get a token via given creds
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $this->data = $request->all();

        $customer = $this->customer->firstWhere('username', $this->data['username']);

        if (!$customer || !Hash::check($this->data['password'], $customer->password)) {
            return response()->json([
                'message' => 'Invalid Credentials',
            ], 401);
        }

        // Login the customer for future request
        Auth::login($customer);
        // get new token
        $tokenResult = $customer->createToken($this->tokenName);
        $token = $tokenResult->token;

        if ($this->data['remember_me']) {
            $token->expires_at = Carbon::now()->addMonth(1);
        }

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }
}
