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
 * @property \Carbon\Carbon|null $createdAt
 * @property \Carbon\Carbon|null $updatedAt
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
        $this->hasMany(CarsInventory::class);
    }
}
