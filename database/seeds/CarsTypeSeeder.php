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
            'name' => 'Motocicleta',
            'description' => 'Motocicletas',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'name' => 'Automóvil',
            'description' => 'Automóviles',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'name' => 'Camión',
            'description' => 'Camiones',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'name' => 'Moto carro',
            'description' => 'Moto carros',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'name' => 'Bicicleta',
            'description' => 'Bicicletas',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'name' => 'Carretilla',
            'description' => 'Carretillas',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'name' => 'Van',
            'description' => 'Van',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('cars_types')->insert([
            'name' => 'Remolque',
            'description' => 'Remolques',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
