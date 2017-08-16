<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Inventory
 *
 * @property int $id
 * @property string $date
 * @property string|null $number
 * @property int $inventoryProcessId
 * @property int $admissionReasonId
 * @property int $carsInventoryId
 * @property \Carbon\Carbon|null $createdAt
 * @property \Carbon\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereAdmissionReasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereCarsInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereInventoryProcessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Inventory extends Model
{
    public function admissionReason()
    {
        $this->belongsTo(AdmissionReason::class);
    }

    public function car()
    {
        $this->hasOne(CarsInventory::class);
    }

    public function inventoryProcesses()
    {
        $this->hasMany(InventoryProcess::class);
    }
}
