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
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(Customer $customer, AuthService $authService)
    {
        $this->customer = $customer;
        $this->authService = $authService;
    }

    /**
     * Register customer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $newCustomer = $this->customer->create($data);
        $newCustomer->customerInfo()->create($data);

        $token = $this->authService->createToken($newCustomer);

        return response()->json($token);
    }

    /**
     * Get a token via given creds
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $data = $request->all();
        $customer = $this->customer->firstWhere($request->only('username'));
        $password = $data['password'];
        $hash = $customer->password;

        if (!Hash::check($password, $hash)) {
            return response()->json([
                'message' => Lang::get('auth.failed'),
            ], 401);
        }

        $token = $this->authService->createToken($customer, $data['remember_me']);

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
