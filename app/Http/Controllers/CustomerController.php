<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CustomerInfoRequest;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomerUpdatePasswordRequest;
use DB;
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
        $data['customers'] = $this->customer->all();
        return view('pages.customer.index', $data);
    }

    /**
     * Show the the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\View\View
     */
    public function show(Customer $customer)
    {
        return view('pages.customer.edit', compact('customer'));
    }
}
