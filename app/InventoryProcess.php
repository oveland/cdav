<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InventoryProcess
 *
 * @property int $id
 * @property string $date
 * @property int $phase
 * @property int $pending_judicial
 * @property int $inventory_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Inventory $inventory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess wherePendingJudicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess wherePhase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InventoryProcess extends Model
{
    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'inventory_id');
    }
}
