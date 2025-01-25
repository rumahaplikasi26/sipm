<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';

    protected $fillable = [
        'uid',
        'employee_id',
        'timestamp',
        'state',
        'machine_sn',
        'shift_id',
        'shift_date'
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

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
