<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AdmissionReason
 *
 * @property int $id
 * @property string $reason
 * @property string|null $description
 * @property \Carbon\Carbon|null $createdAt
 * @property \Carbon\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdmissionReason extends Model
{
    public function inventories()
    {
        $this->hasMany(Inventory::class);
    }
}
