<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use CrudTrait, HasFactory;

    protected $fillable = ['teacher_name', 'room_name', 'group_name', 'day', 'period'];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(teacher::class);
    }
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
