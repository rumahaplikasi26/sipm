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
        'scope_id',
        'total_estimate',
        'type_estimate',
        'forecast_date',
        'plan_date',
        'actual_date',
        'supervisor_id',
        'description',
        'progress',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function scope()
    {
        return $this->belongsTo(Scope::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class);
    }

    public function issues()
    {
        return $this->hasMany(ActivityIssue::class);
    }

    public function progress()
    {
        return $this->hasMany(ActivityProgress::class);
    }
}
