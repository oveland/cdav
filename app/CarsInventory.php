<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\CarsInventory
 *
 * @property int $id
 * @property string $plate
 * @property string $engine_number
 * @property string $chassis_number
 * @property string $model
 * @property string $color
 * @property string $registration_city
 * @property bool $pending_judicial
 * @property int $inventory_id
 * @property int $cars_type_id
 * @property int $cars_state_id
 * @property int $cars_proprietary_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\AbandonmentDeclaration $abandonmentDeclaration
 * @property-read \App\Inventory $inventory
 * @property-read \App\CarsLimitation $limitation
 * @property-read \App\CarsProprietary $proprietary
 * @property-read \App\CarsState $state
 * @property-read \App\CarsType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereCarsProprietaryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereCarsStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereCarsTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereChassisNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereEngineNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory wherePendingJudicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory wherePlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereRegistrationCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsInventory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarsInventory extends Model
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
        'plate', 'engine_number', 'chassis_number', 'model', 'color', 'registration_city', 'pending_judicial', 'cars_type_id', 'cars_state_id'
    ];

    public function type()
    {
        return $this->belongsTo(CarsType::class, 'cars_type_id');
    }

    public function state()
    {
        return $this->belongsTo(CarsState::class, 'cars_state_id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function proprietary()
    {
        return $this->belongsTo(CarsProprietary::class, 'cars_proprietary_id');
    }

    public function limitation()
    {
        return $this->hasOne(CarsLimitation::class);
    }

    public function abandonmentDeclaration()
    {
        return $this->hasOne(AbandonmentDeclaration::class);
    }

    public function hasPendingJudicial()
    {
        return $this->pending_judicial;
    }
}
