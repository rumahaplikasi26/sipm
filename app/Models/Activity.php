<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'scope_id',
        'group_id',
        'position_id',
        'total_estimate',
        'forecast_date',
        'plan_date',
        'actual_date',
        'supervisor_id',
        'description',
        'status_id'
    ];

    public function getProgressColorAttribute()
    {
        if($this->progress  == 0) {
            return 'danger';
        } else if ($this->progress < 50) {
            return 'warning';
        } else {
            return 'success';
        }
    }

    public function scope()
    {
        return $this->belongsTo(Scope::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class);
    }

    public function issues()
    {
        return $this->hasMany(ActivityIssue::class);
    }

    public function status()
    {
        return $this->belongsTo(StatusActivity::class, 'status_id');
    }

    public function historyProgress()
    {
        return $this->hasMany(ActivityProgress::class);
    }
}
