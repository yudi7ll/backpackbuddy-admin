<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomerUpdatePasswordRequest;
use Hash;
use Session;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->middleware('auth');
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['customers'] = $this->customer->all();
        return view('pages.customer.index', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('pages.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\CustomerRequest  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->data = $request->except('password');
        $customer->update($this->data);

        return redirect()->back()->with('success', 'Data has been updated!');
    }

    /**
     * Update the password of specified data
     *
     * @param \Illuminate\Http\Requests\CustomerUpdatePasswordRequest $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(CustomerUpdatePasswordRequest $request, Customer $customer)
    {
        $this->data = $request->all();
        $this->data['password'] = Hash::make($this->data['password']);
        $customer->update($this->data);

        return redirect()->back()->with('success', 'Customer password has been changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return Session::flash('success', 'The customer has been removed!');
    }
}
