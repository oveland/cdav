<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CarsProprietary
 *
 * @property int $id
 * @property string $identity
 * @property string $name
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CarsInventory[] $cars
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsProprietary whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsProprietary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsProprietary whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsProprietary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsProprietary whereIdentity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsProprietary whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsProprietary wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarsProprietary whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarsProprietary extends Model
{
    public function cars()
    {
        return $this->hasMany(CarsInventory::class);
    }
}
