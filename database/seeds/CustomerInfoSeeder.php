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
        $newCustomerInfo = factory(CustomerInfo::class, 50)->make();

        foreach ($newCustomerInfo as $key => $customerInfo) {
            Customer::find($key+1)->customerInfo()->create($customerInfo->toArray());
        }
    }
}
