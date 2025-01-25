<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class MonitoringPresentDetail extends Model
{
    protected $table = 'monitoring_present_details';

    protected $fillable = ['monitoring_present_id', 'employee_id', 'is_present', 'note'];

    public function monitoringPresent()
    {
        return $this->belongsTo(MonitoringPresent::class, 'monitoring_present_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
