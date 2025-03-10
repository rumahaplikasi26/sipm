<?php

namespace App\Livewire\Outbound;

use App\Models\Employee;
use App\Models\Group;
use App\Models\Inventory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class OutboundForm extends Component
{
    use LivewireAlert, WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(except: '')]

    public $search = '';
    public $perPage = 30;
    public $groups, $employees;

    public $inventory_id, $supervisor_id, $group_id, $employee_id, $quantity, $is_group = false, $condition, $borrow_date, $description, $created_by;

    protected $listeners = [
        'refreshIndex' => 'handleRefresh',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function handleRefresh()
    {
        $this->alert('success', 'Refreshed successfully');
        $this->dispatch('$refresh');
    }

    public function resetFilter()
    {
        $this->search = "";
        $this->resetPage();
    }

    public function mount()
    {
        $this->groups = Group::with('supervisor')->get();
        $this->employees = Employee::get();
    }

    public function updatedIsGroup($value)
    {
        if ($value) {
            $this->employee_id = null; // Reset employee jika group dipilih
        } else {
            $this->group_id = null; // Reset group jika tidak memilih group
        }

        $this->dispatch('refreshSelect2');
    }

    #[On('updateSelect2')]
    public function updatedSelect2($model, $value)
    {
        $this->$model = $value;
        $this->dispatch('refreshSelect2');
    }

    public function render()
    {
        $inventories = Inventory::with('category', 'warehouse')->when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')->orWhere('serial_number', 'like', '%' . $this->search . '%');
        })->paginate($this->perPage);

        return view('livewire.outbound.outbound-form', compact('inventories'))->layout('layouts.app-inventory', ['title' => 'Outbound Create']);
    }
}
