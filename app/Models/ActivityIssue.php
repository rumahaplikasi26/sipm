<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityIssue extends Model
{
    protected $fillable = [
        'date',
        'activity_id',
        'category_dependency_id',
        'description',
        'percentage_dependency',
        'percentage_solution',
        'resolved_at',
        'notified_site_manager_at',
        'notified_project_manager_at',
        'notified_project_director_at',
    ];

    public function categoryDependency()
    {
        return $this->belongsTo(CategoryDependency::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
