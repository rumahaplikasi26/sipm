<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'date',
        'title',
        'slug',
        'group_id',
        'position_id',
        'total_estimate',
        'type_estimate',
        'forecast_date',
        'plan_date',
        'actual_date',
        'supervisor_id',
        'description',
        'status_id'
    ];

    protected $casts = [
        'date' => 'date',
    ];

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

    public function details()
    {
        return $this->hasMany(ActivityDetail::class);
    }
}
