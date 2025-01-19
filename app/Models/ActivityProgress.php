<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityProgress extends Model
{
    protected $table = 'activity_progress';

    protected $fillable = [
        'activity_detail_id',
        'user_id',
        'percentage',
    ];

    public function activityDetail()
    {
        return $this->belongsTo(ActivityDetail::class);
    }
}
