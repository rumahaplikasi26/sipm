<div>
    @livewire('component.layout.breadcrumb', ['breadcrumbs' => [['name' => 'Outbound Create', 'url' => route('inventory.outbound')]]], key('breadcrumb'))

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Option</h4>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Date</label>
                        <input type="date" class="form-control @error('borrow_date') is-invalid @enderror"
                            wire:model="borrow_date" id="formrow-firstname-input" placeholder="Enter Borrow Date"
                            autocomplete="off" value="{{ old('borrow_date') }}">

                        @error('borrow_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Is Group?</label>
                        <select class="form-select" wire:model.live="is_group">
                            <option value="">-- Select --</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Group</label>
                        <select class="form-select" wire:model="group_id" id="group_id"
                            @if (!$is_group) disabled @endif>
                            <option value="">-- Select Group --</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }} | {{ $group->supervisor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Employee</label>
                        <select class="form-select" wire:model="employee_id" id="employee_id"
                            @if ($is_group) disabled @endif>
                            <option value="">-- Select Employee --</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md">
            <div class="row mb-3">
                <div class="col-xl-4 col-sm-6">
                    <div class="mt-2">
                        <h5>INVENTORIES</h5>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-6">
                    <form class="mt-4 mt-sm-0 float-sm-end d-sm-flex align-items-center">
                        <div class="search-box me-2">
                            <div class="position-relative">
                                <input type="text" class="form-control border-0" placeholder="Search..."
                                    wire:model.live.delay="search">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                @foreach ($inventories as $inventory)
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-4">
                                        <div class="avatar-md">
                                            <span
                                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                {{ substr($inventory->name, 0, 1) }}
                                            </span>
                                        </div>
                                    </div>


                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-15"><a href="javascript: void(0);"
                                                class="text-dark">{{ $inventory->name }}</a></h5>
                                        <p class="text-muted mb-1">{{ $inventory->serial_number }}</p>
                                        <p class="text-muted mb-1">{{ $inventory->warehouse->name }}</p>
                                        <p class="text-muted mb-1">{{ $inventory->category->name }}</p>
                                        {{-- <div class="avatar-group">
                                        <div class="avatar-group-item">
                                            <a href="javascript: void(0);" class="d-inline-block">
                                                <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs">
                                            </a>
                                        </div>
                                        <div class="avatar-group-item">
                                            <a href="javascript: void(0);" class="d-inline-block">
                                                <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xs">
                                            </a>
                                        </div>
                                        <div class="avatar-group-item">
                                            <a href="javascript: void(0);" class="d-inline-block">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-success text-white font-size-16">
                                                        A
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="avatar-group-item">
                                            <a href="javascript: void(0);" class="d-inline-block">
                                                <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xs">
                                            </a>
                                        </div>
                                    </div> --}}
                                    </div>
                                </div>

                                <div class="d-flex mt-3 justify-content-between">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item me-3">
                                            @if ($inventory->type == 'Consumable')
                                                <span class="badge bg-success">Consumable</span>
                                            @elseif($inventory->type == 'Asset')
                                                <span class="badge bg-warning">Asset</span>
                                            @else
                                                <span class="badge bg-info">Service</span>
                                            @endif
                                        </li>
                                        <li class="list-inline-item me-3">
                                            <i class="bx bx-calendar me-1"></i> {{ $inventory->created_at->diffForHumans() }}
                                        </li>
                                        <li class="list-inline-item me-3">
                                            <i class="bx bx-briefcase me-1"></i> {{ $inventory->stock }} {{ $inventory->unit}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="px-4 py-3 border-top">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3">
                                        <button class="btn btn-sm btn-info" wire:click="editInventory({{ $inventory->id }})"><span class="bx bx-pencil"></span></button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button class="btn btn-sm btn-danger" wire:click="deleteInventory({{ $inventory->id }})"><span class="bx bx-trash"></span></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @push('styles')
        <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    @push('js')
        <script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
        <script>
            var selectGroup = $('#group_id');
            var selectEmployee = $('#employee_id');

            function initSelect2() {
                selectGroup.select2({
                    placeholder: 'Select an option',
                    width: '100%',
                });

                selectEmployee.select2({
                    placeholder: 'Select an option',
                    width: '100%',
                });
            }

            document.addEventListener('livewire:init', function() {

                initSelect2();

                selectGroup.on('change', function() {
                    Livewire.dispatch('updateSelect2', {
                        model: 'group_id',
                        value: this.value
                    });
                });

                selectEmployee.on('change', function() {
                    Livewire.dispatch('updateSelect2', {
                        model: 'employee_id',
                        value: this.value
                    });
                });

                Livewire.on('refreshSelect2', function() {
                    setTimeout(function() {
                        initSelect2();
                    }, 500);

                    console.log('refreshSelect2');
                });
            });

            document.addEventListener("DOMContentLoaded", initSelect2);
            document.addEventListener("livewire:navigated", initSelect2);
        </script>
    @endpush
</div>
