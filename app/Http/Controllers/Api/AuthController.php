<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Api\AuthService;
use Auth;

class AuthController extends Controller
{
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
        $token = resolve(AuthService::class)->createToken($newCustomer);

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
        $customer = AuthService::checkCreds($this->data);
        $token = resolve(AuthService::class)->createToken($customer, $this->data['remember_me']);

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
