<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AbandonmentDeclaration
 *
 * @property int $id
 * @property string $date
 * @property string $resolution_number
 * @property int $cars_inventory_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\CarsInventory $car
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AbandonmentDeclaration whereCarsInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AbandonmentDeclaration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AbandonmentDeclaration whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AbandonmentDeclaration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AbandonmentDeclaration whereResolutionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AbandonmentDeclaration whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AbandonmentDeclaration extends Model
{
    public function car()
    {
        return $this->belongsTo(CarsInventory::class,'cars_inventory_id');
    }
}
