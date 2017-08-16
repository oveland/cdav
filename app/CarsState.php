<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CarsState
 *
 * @property int $id
 * @property string $state
 * @property string|null $description
 * @property \Carbon\Carbon|null $createdAt
 * @property \Carbon\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsState whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsState whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsState whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsState whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsState whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarsState extends Model
{
    public function cars()
    {
        $this->hasMany(CarsInventory::class);
    }
}
