<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'email',
        'position_id',
        'group_id',
        'phone',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function schedules()
    {
        return $this->hasMany(ShiftSchedule::class);
    }
}
