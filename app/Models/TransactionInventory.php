<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionInventory extends Model
{
    protected $fillable = [
        'transaction_id',
        'inventory_id',
        'quantity',
        'employee_id',
        'supervisor_id',
        'is_group',
        'group_id',
        'borrow_date',
        'return_date',
        'description',
        'created_by',
        'updated_by',
        'condition',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
