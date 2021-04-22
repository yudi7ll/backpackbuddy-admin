<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerInfoRequest;
use App\Http\Resources\CurrentCustomerInfoResource;
use App\Http\Resources\CurrentCustomerResource;
use Auth;

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
        $data = auth()->user()->customerInfo;
        return new CurrentCustomerInfoResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerInfoRequest $request)
    {
        $data = $request->all();
        return Auth::user()->customerInfo()->update($data);
    }
}
