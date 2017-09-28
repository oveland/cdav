<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CarsLimitation
 *
 * @property int $id
 * @property string $name
 * @property string $issuing
 * @property string $motive
 * @property string|null $description
 * @property int $cars_inventory_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\CarsInventory $car
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereCarsInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereIssuing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereMotive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarsLimitation extends Model
{
    protected function getDateFormat()
    {
        return config('app.date_format');
    }

    public function car()
    {
        return $this->belongsTo(CarsInventory::class,'cars_inventory_id');
    }
}
