<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Api\AuthService;
use Auth;
use Hash;
use Lang;

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

        $token = AuthService::createToken($newCustomer);


        return response()->json($token);
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
                'message' => Lang::get('auth.failed'),
            ], 401);
        }

        $token = AuthService::createToken($customer, $this->data['remember_me']);

        return response()->json($token);
    }

    /**
     * Logout the customer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::user()->token()->revoke();
        return response()->json(['success' => true], 200);
    }
}
