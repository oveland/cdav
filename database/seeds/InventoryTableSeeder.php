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
        for ($i = 0; $i < 100; $i++) {
            $inventory = factory(\App\Inventory::class)->create();

            $carInventory = factory(\App\CarsInventory::class)->create([
                'inventory_id' => $inventory->id
            ]);

            $carLimitation = factory(\App\CarsLimitation::class)->create([
                'cars_inventory_id' => $carInventory->id
            ]);

            $canPassToPhase2 = $inventory->admissionReason->canPassToPhase2($carInventory->pending_judicial);
            $phase = $canPassToPhase2 ? random_int(1, 3) : 1;
            $inventoryProcess = factory(\App\InventoryProcess::class)->create([
                'inventory_id' => $inventory->id,
                'phase' => $phase,
                'started' => $phase == 1 ? true : (rand(0, 1) == 1),
            ]);
        }
    }
}
