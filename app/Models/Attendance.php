<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getDateStringAttribute()
    {
        // Hari, tanggal bulan tahun
        return Carbon::parse($this->timestamp)->isoFormat('dddd, DD MMMM YYYY');
    }

    public function getTimeAttribute()
    {
        return date('H:i:s', strtotime($this->timestamp));
    }

    public function getConfigAttribute()
    {
        $time = date('H:i:s', strtotime($this->timestamp));
        return AttendanceConfig::where('start_time', '<=', $time)->where('end_time', '>=', $time)->first();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
