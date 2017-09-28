<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AdmissionReason
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property bool $parent
 * @property int|null $admission_reason_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AdmissionReason[] $admissionReason
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AdmissionReason[] $admissionReasons
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Inventory[] $inventories
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason courtOrder()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason parents()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereAdmissionReasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AdmissionReason whereParent($value)
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
        return $this->hasMany(Inventory::class);
    }

    public function scopeParents($query)
    {
        return $query->where('parent', true);
    }

    public function scopeCourtOrder($query)
    {
        return $query->where('admission_reason_id', 1);
    }

    public function admissionReasons()
    {
        return $this->hasMany(AdmissionReason::class);
    }

    public function admissionReason()
    {
        return $this->belongsTo(AdmissionReason::class);
    }

    public function isContravention()
    {
        return $this->id == 4;
    }

    public function canPassToPhase2($pendingJudicial)
    {
        return !$pendingJudicial && $this->isContravention();
    }
}
