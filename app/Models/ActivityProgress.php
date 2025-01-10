<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityProgress extends Model
{
    protected $table = 'activity_progress';

    protected $fillable = [
        'activity_id',
        'user_id',
        'percentage',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
