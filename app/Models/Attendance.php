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

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
