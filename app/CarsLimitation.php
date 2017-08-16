<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CarsLimitation
 *
 * @property int $id
 * @property string $limitation
 * @property string|null $description
 * @property \Carbon\Carbon|null $createdAt
 * @property \Carbon\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereLimitation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsLimitation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarsLimitation extends Model
{
    public function car()
    {
        $this->belongsTo(CarsInventory::class);
    }
}
