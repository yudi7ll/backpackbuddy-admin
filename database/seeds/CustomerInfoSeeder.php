<?php

use App\Customer;
use App\CustomerInfo;
use Illuminate\Database\Seeder;

class CustomerInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = Customer::all();

        foreach ($customers as $customer) {
            $customer->customerInfo()->create(factory(CustomerInfo::class)->make()->toArray());
        }
    }
}
