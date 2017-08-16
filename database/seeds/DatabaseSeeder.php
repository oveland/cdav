<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdmissionReasonTableSeeder::class);
        $this->call(CarsStateTableSeeder::class);
        $this->call(InventoryTableSeeder::class);

        //$this->call(CarsProprietaryTableSeeder::class);
        //$this->call(CarsInventoryTableSeeder::class);
        //$this->call(CarsLimitationTableSeeder::class);
        //$this->call(AbandonmentDeclarationTableSeeder::class);
        //$this->call(InventoryProcessTableSeeder::class);
    }
}
