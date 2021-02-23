<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CustomerInfoRequest;
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->data['customers'] = $this->customer->all();
        return view('pages.customer.index', $this->data);
    }

    public function store()
    {
        // TODO
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\View\View
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
     * @return \Illuminate\Routing\RedirectResponse
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
     * @return \Illuminate\Routing\RedirectResponse
     */
    public function updatePassword(CustomerUpdatePasswordRequest $request, Customer $customer)
    {
        $this->data = $request->all();
        $this->data['password'] = Hash::make($this->data['password']);
        $customer->update($this->data);

        return redirect()->back()->with('success', 'Customer password has been changed!');
    }

    /**
     * Update the Customer Info of specified data
     *
     * @param \Illuminate\Http\Requests\CustomerInfoRequest $request
     * @param \App\Customer $customer
     * @return \Illuminate\Routing\RedirectResponse
     */
    public function updateInfo(CustomerInfoRequest $request, Customer $customer)
    {
        $this->data = $request->all();
        $customer->customerInfo()->update($this->data);

        return redirect()->back()->with('success', 'Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Support\Facades\Session
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return Session::flash('success', 'Data has been deleted!');
    }
}
