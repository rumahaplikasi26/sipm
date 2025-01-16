<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = [
        'uid',
        'employee_id',
        'timestamp',
        'state'
    ];

    public function getDateAttribute()
    {
        return date('Y-m-d', strtotime($this->timestamp));
    }

    public function getTimeAttribute()
    {
        return date('H:i:s', strtotime($this->timestamp));
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
