<?php

use Illuminate\Database\Seeder;

class CarsStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars_states')->insert([
            'state' => 'Bueno',
            'description' => 'Estado sin anomalías o daños significativos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_states')->insert([
            'state' => 'Regular',
            'description' => 'Estado anomalías o daños no serios - Avalúo Actual',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_states')->insert([
            'state' => 'Malo',
            'description' => 'Mal estado - Avalúo Comercial',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
