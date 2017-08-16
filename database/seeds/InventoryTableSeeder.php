<?php

use Illuminate\Database\Seeder;

class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $inventory = factory(\App\Inventory::class)->create();

            $carInventory = factory(\App\CarsInventory::class)->create([
                'inventory_id' => $inventory->id
            ]);

            $carLimitation = factory(\App\CarsLimitation::class)->create([
                'cars_inventory_id' => $carInventory->id
            ]);

            $inventoryProcess = factory(\App\InventoryProcess::class)->create([
                'inventory_id' => $inventory->id
            ]);
        }
    }
}
