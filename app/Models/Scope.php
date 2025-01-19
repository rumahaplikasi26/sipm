<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scope extends Model
{
    protected $fillable = ['name', 'description'];

    public function activityDetails()
    {
        return $this->hasMany(ActivityDetail::class);
    }
}
