<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CarsType
 *
 * @property int $id
 * @property string $type
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsType whereName($value)
 */
class CarsType extends Model
{
    //
}
