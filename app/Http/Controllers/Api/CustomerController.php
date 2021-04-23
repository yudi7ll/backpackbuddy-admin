<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CustomerRequest;
use App\Http\Requests\Api\UpdatePasswordRequest;
use App\Http\Requests\CustomerInfoRequest;
use App\Http\Resources\CurrentCustomerInfoResource;
use App\Http\Resources\CurrentCustomerResource;
use Auth;
use Hash;
use Lang;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
                    'password' => [Lang::get('validation.password')]
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
        $customer = Auth::user();
        $customer->name = $request->name;
        $customer->save();

        return Auth::user()->customerInfo()->update($request->except('name'));
    }
}
