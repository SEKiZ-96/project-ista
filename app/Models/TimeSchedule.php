<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class TimeSchedule extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'time_schedules';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['teacher','room','group','day','period'];
   
    // protected $hidden = [];
    public function Teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
    public function Group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
    public function Room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    // -----------------
    
    public function teacherr()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher', 'id');

    }

    public function roomm()
    {
        return $this->belongsTo('App\Models\Room', 'room', 'id');
    }

    public function groupp()
    {
        return $this->belongsTo('App\Models\Group', 'group', 'id');
    }
    public function idd()
    {
        return $this->belongsTo('App\Models\TimeSchedule', 'id', 'id');
    }
    
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
