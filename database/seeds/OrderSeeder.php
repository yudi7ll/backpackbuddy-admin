<?php

use App\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create(['status' => 1]);
        factory(Order::class, 12)->create([
            'status' => 2,
            'completed_at' => now(),
        ]);
        factory(Order::class, 3)->create([
            'status' => 3,
            'completed_at' => now()
        ]);
    }
}
