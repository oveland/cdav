<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * App\InventoryProcess
 *
 * @property int $id
 * @property \Carbon\Carbon $date
 * @property int $phase
 * @property bool $started
 * @property int $notification_phase
 * @property \Carbon\Carbon|null $date_notification_phase
 * @property int $inventory_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Inventory $inventory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess abandoned()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess phase1()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess phase2()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess phase3()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess started()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereDateNotificationPhase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereNotificationPhase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess wherePhase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereStarted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $observations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereObservations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess notice()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess personal()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryProcess whereDate($value)
 */
class InventoryProcess extends Model
{
    const INIT_INVENTORY_PHASE = 1;
    const ABANDONMENT_PHASE = 2;
    const ESTRANGEMENT_PHASE = 3;

    const INIT_NOTIFICATION_PHASE = 0;
    const PERSONAL_NOTIFICATION_PHASE = 1;
    const NOTICE_NOTIFICATION_PHASE = 2;

    protected function getDateFormat()
    {
        return config('app.date_format');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'phase', 'started', 'notification_phase', 'date_notification_phase'
    ];

    protected $dates = ['date', 'date_notification_phase'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    /**
     * Scope a query to Inventories phase InitInventory.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePhase1($query)
    {
        return $query->where('phase', $this::INIT_INVENTORY_PHASE);
    }

    /**
     * Scope a query to Inventories phase 2.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePhase2($query)
    {
        return $query->where('phase', $this::ABANDONMENT_PHASE);
    }

    /**
     * Scope a query to Inventories phase 3.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePhase3($query)
    {
        return $query->where('phase', $this::ESTRANGEMENT_PHASE);
    }

    /**
     * Scope a query to Inventories with personal notification.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePersonal($query)
    {
        return $query->where('notification_phase', $this::PERSONAL_NOTIFICATION_PHASE);
    }

    /**
     * Scope a query to Inventories with notification by notice.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotice($query)
    {
        return $query->where('notification_phase', $this::NOTICE_NOTIFICATION_PHASE);
    }

    /**
     * Scope a query to Inventories started current process.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStarted($query)
    {
        return $query->where('started', true);
    }

    /**
     * Scope a query to Inventories with abandoned vehicles (created over a year ago).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAbandoned($query)
    {
        return $query->where('phase', $this::INIT_INVENTORY_PHASE)->where('date', '<', Carbon::now()->subYears(1));
    }

    /**
     * @return bool
     */
    public function isStartAbandonedState()
    {
        return $this->phase == $this::ABANDONMENT_PHASE && !$this->started;
    }

    /**
     * @return bool
     */
    public function isInAbandonedState()
    {
        return $this->phase == $this::ABANDONMENT_PHASE;
    }

    /**
     * @return bool
     */
    public function isEndAbandonedState()
    {
        return $this->phase == $this::ABANDONMENT_PHASE && $this->started;
    }

    /**
     * @return bool
     */
    public function isStartEstrangementState()
    {
        return $this->phase == $this::ESTRANGEMENT_PHASE && !$this->started;
    }

    /**
     * @return bool
     */
    public function isInEstrangementState()
    {
        return $this->phase == $this::ESTRANGEMENT_PHASE;
    }

    /**
     * @return bool
     */
    public function isEndEstrangementState()
    {
        return $this->phase == $this::ESTRANGEMENT_PHASE && $this->started;
    }


    public function isContravention()
    {
        return $this->inventory->admissionReason->isContravention();
    }

    public function canPassToPhase2()
    {
        return !$this->inventory->car->pending_judicial && $this->isContravention();
    }

    public function setStateToInitialPhase()
    {
        $this->started = false;
        $this->notification_phase = $this::INIT_NOTIFICATION_PHASE;
        $this->date_notification_phase = Carbon::now();
        return $this;
    }

    public function withOutNotification()
    {
        return $this->notification_phase == $this::INIT_NOTIFICATION_PHASE;
    }

    public function withPersonalNotification()
    {
        return $this->notification_phase == $this::PERSONAL_NOTIFICATION_PHASE;
    }

    public function withNoticeNotification()
    {
        return $this->notification_phase == $this::NOTICE_NOTIFICATION_PHASE;
    }
}
