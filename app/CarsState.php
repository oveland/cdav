<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CarsState
 *
 * @property int $id
 * @property string $state
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CarsInventory[] $cars
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsState whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsState whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsState whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsState whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsState whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $color_class
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsState whereColorClass($value)
 */
class CarsState extends Model
{
    protected function getDateFormat()
    {
        return config('app.date_format');
    }

    public function cars()
    {
        return $this->hasMany(CarsInventory::class);
    }
}
