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
            'name' => 'Bueno',
            'description' => 'Estado sin anomalías o daños significativos',
            'color_class' => 'bg-green-seagreen',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_states')->insert([
            'name' => 'Regular',
            'description' => 'Estado anomalías o daños no serios - Avalúo Actual',
            'color_class' => 'bg-yellow-lemon',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_states')->insert([
            'name' => 'Malo',
            'description' => 'Mal estado - Avalúo Comercial',
            'color_class' => 'bg-red-flamingo',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
