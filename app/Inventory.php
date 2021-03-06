<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Inventory
 *
 * @property int $id
 * @property string $date
 * @property string|null $number
 * @property int $admission_reason_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property mixed $admission_reason
 * @property mixed $inventory_processes
 * @property mixed $files
 * @property-read \App\AdmissionReason $admissionReason
 * @property-read \App\CarsInventory $car
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\InventoryProcess[] $inventoryProcesses
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereAdmissionReasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inventory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Inventory extends Model
{
    protected function getDateFormat()
    {
        return config('app.date_format');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'admission_reason_id'
    ];

    protected $dates = ['date'];

    public function admissionReason()
    {
        return $this->belongsTo(AdmissionReason::class, 'admission_reason_id');
    }

    public function car()
    {
        return $this->hasOne(CarsInventory::class);
    }

    public function inventoryProcesses()
    {
        return $this->hasOne(InventoryProcess::class);
    }

    public function files(){
        return $this->hasMany(InventoryFile::class);
    }
}
