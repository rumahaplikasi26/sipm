<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'position_id',
        'group_id',
        'phone',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
