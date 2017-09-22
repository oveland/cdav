<?php

use Illuminate\Database\Seeder;

class CarsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars_types')->insert([
            'type' => 'Motocicletas',
            'description' => 'Motocicletas',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'type' => 'Automóvil',
            'description' => 'Automóvil',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'type' => 'Camión',
            'description' => 'Camión',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'type' => 'Moto carro',
            'description' => 'Moto carro',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'type' => 'Bicicleta',
            'description' => 'Bicicleta',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'type' => 'Carretillas',
            'description' => 'Carretillas',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'type' => 'Van',
            'description' => 'Van',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'type' => 'Remolques',
            'description' => 'Remolques',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
