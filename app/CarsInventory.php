<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CarsInventory
 *
 * @property int $id
 * @property string $plate
 * @property string $engineNumber
 * @property string $chassisNumber
 * @property string $model
 * @property string $color
 * @property string $registrationCity
 * @property int $carsStateId
 * @property int $carsProprietaryId
 * @property \Carbon\Carbon|null $createdAt
 * @property \Carbon\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereCarsProprietaryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereCarsStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereChassisNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereEngineNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory wherePlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereRegistrationCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarsInventory extends Model
{
    public function state(){
        $this->belongsTo(CarsState::class);
    }

    public function inventory(){
        $this->belongsTo(Inventory::class);
    }

    public function proprietary(){
        $this->belongsTo(CarsProprietary::class);
    }

    public function limitation(){
        $this->hasOne(CarsLimitation::class);
    }

    public function abandonmentDeclaration()
    {
        $this->hasOne(AbandonmentDeclaration::class);
    }
}
