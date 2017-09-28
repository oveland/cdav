<?php

use Illuminate\Database\Seeder;
use App\AdmissionReason;

class AdmissionReasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courtOrder = AdmissionReason::create([
            'name' => 'Orden Judicial',
            'description' => 'Ingreso por orden judicial',
            'parent' => true,
            'admission_reason_id' => null
        ]);

        AdmissionReason::create([
            'name' => 'Lesiones',
            'description' => 'Ingreso por lesiones',
            'admission_reason_id' => $courtOrder->id
        ]);

        AdmissionReason::create([
            'name' => 'Homicidio',
            'description' => 'Ingreso por homicidio',
            'admission_reason_id' => $courtOrder->id
        ]);

        AdmissionReason::create([
            'name' => 'Contravención',
            'description' => 'Ingreso por contravención',
            'admission_reason_id' => $courtOrder->id
        ]);

        AdmissionReason::create([
            'name' => 'Embargo',
            'description' => 'Ingreso por embargo',
            'admission_reason_id' => $courtOrder->id
        ]);

        $traffic_violation = AdmissionReason::create([
            'name' => 'Infracción de Tránsito',
            'description' => 'Ingreso por infracción de tránsito',
            'parent' => true,
            'admission_reason_id' => null
        ]);

        $traffic_violation->admission_reason_id = $traffic_violation->id;
        $traffic_violation->save();
    }
}
