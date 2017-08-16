<?php

use Illuminate\Database\Seeder;

class AdmissionReasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admission_reasons')->insert([
            'reason' => 'Lesiones',
            'description' => 'Ingreso por lesiones',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('admission_reasons')->insert([
            'reason' => 'Homicidio',
            'description' => 'Ingreso por Homicidio',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('admission_reasons')->insert([
            'reason' => 'Contravención',
            'description' => 'Ingreso por Contravención',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('admission_reasons')->insert([
            'reason' => 'Embargo',
            'description' => 'Ingreso por Embargo',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
