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

        Customer::create([
            'name' => 'Yudi',
            'username' => 'yudi12',
            'email' => 'yudi@email.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ])->customerInfo()->create([
            'address_1' => 'Denpasar',
            'address_2' => 'Denpasar Barat',
            'postcode' => '80117',
            'city' => 'Denpasar',
            'identity' => '123612647126712',
            'telp' => '08528374134',
        ]);;
    }
}
