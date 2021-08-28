<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CustomerRequest;
use App\Http\Requests\Api\CustomerResetPasswordRequest;
use App\Http\Requests\Api\CustomerResetPasswordTokenRequest;
use App\Http\Requests\Api\UpdatePasswordRequest;
use App\Http\Requests\CustomerInfoRequest;
use App\Http\Resources\CurrentCustomerInfoResource;
use App\Http\Resources\CurrentCustomerResource;
use App\Mail\CustomerPasswordReset;
use Auth;
use Hash;
use Lang;
use Mail;

class CustomerController extends Controller
{
    /**
     * Get the current customer data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        return new CurrentCustomerResource(auth()->user());
    }

    /**
     * Get the current customer private info
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showInfo()
    {
        $data = Auth::user()->customerInfo;

        return new CurrentCustomerInfoResource($data);
    }

    /**
     * Update current customer account
     *
     * @param \App\Http\Requests\Api\CustomerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CustomerRequest $request)
    {
        $data = $request->all();

        return Auth::user()->update($data);
    }

    /**
     * Update password of current customer
     *
     * @param \App\Http\Requests\Api\UpdatePasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $data = $request->all();

        if (!Hash::check($data['old_password'], auth()->user()->password)) {
            return response()->json([
                'errors' => [
                    'old_password' => [Lang::get('validation.password')]
                ],
                'message' => Lang::get('validation.password')
            ], 401);
        }

        $data['password'] = bcrypt($data['password']);

        return Auth::user()->update($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\CustomerInfoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(CustomerInfoRequest $request)
    {
        $data = $request->validated();

        return Auth::user()
            ->customerInfo()
            ->update($data);
    }

    /**
     * Send token to customer email
     *
     * @param \App\Http\Requests\Api\CustomerResetPasswordTokenRequest $request
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(CustomerResetPasswordTokenRequest $request)
    {
        try {
            $data = $request->validated();
            $customer = Customer::where('email', $data['email']);
            $token = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);

            $customer->update([
                'password_reset_token' => $token,
                'password_reset_token_expire_at' => now()->addHour()
            ]);

            Mail::to($data['email'])->send(new CustomerPasswordReset($token));

            return response()->json(['message' => trans('passwords.token-sent')]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something wrong, please try again later'], 401);
        }
    }

    /**
     * Reset customer password
     *
     * @param \App\Http\Requests\Api\CustomerResetPasswordRequest $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(CustomerResetPasswordRequest $request)
    {
        try {
            $data = $request->validated();
            $customer = Customer::firstWhere('email', $data['email']);

            // check if the user have token
            if (!$customer->password_reset_token) {
                return response()->json(['message' => trans('passwords.token')]);
            }

            // check the token not expire
            if ($customer->password_reset_token_expire_at < now()) {
                return response()->json(['message' => trans('passwords.expire')]);
            }

            // check the token
            if ($data['token'] != $customer->password_reset_token) {
                return response()->json(['message' => trans('passwords.token-sent')]);
            }

            $customer->update([
                'password' => bcrypt($data['password']),
                'password_reset_token' => null,
                'password_reset_token_expire_at' => null
            ]);

            return response()->json(['message' => 'Your password has been reset!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something wrong, please try again later'], 401);
        }
    }
}
