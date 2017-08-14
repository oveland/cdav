<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InventoryProcess
 *
 * @property int $id
 * @property string $date
 * @property int $pendingJudicial
 * @property int $carsLimitationId
 * @property int $abandonmentDeclarationId
 * @property \Carbon\Carbon|null $createdAt
 * @property \Carbon\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereAbandonmentDeclarationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereCarsLimitationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess wherePendingJudicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InventoryProcess extends Model
{
    //
}
