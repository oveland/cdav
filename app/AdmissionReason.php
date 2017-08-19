<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AdmissionReason
 *
 * @property int $id
 * @property string $reason
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Inventory[] $inventories
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdmissionReason extends Model
{
    protected function getDateFormat()
    {
        return config('app.date_format');
    }

    public function inventories()
    {
        return  $this->hasMany(Inventory::class);
    }
}
