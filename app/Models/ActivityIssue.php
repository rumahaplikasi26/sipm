<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityIssue extends Model
{
    protected $fillable = ['activity_id', 'category_dependency_id', 'description'];

    public function categoryDependency()
    {
        return $this->belongsTo(CategoryDependency::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
