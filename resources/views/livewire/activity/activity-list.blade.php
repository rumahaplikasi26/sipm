<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="d-flex justify-content-end">
                <div class="flex-shrink-0">
                    <a href="#!" class="btn btn-primary" wire:click="$dispatch('showForm')">Add New Activity</a>
                    <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                    <div class="dropdown d-inline-block">

                        <button type="menu" class="btn btn-success" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                class="mdi mdi-dots-vertical"></i></button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card job-filter">
                <div class="card-body">
                    <form action="javascript:void(0);">
                        <div class="row g-3">
                            <div class="col-xxl-2 col-lg-6">
                                <input type="search" class="form-control" id="searchInput" wire:model="search"
                                    placeholder="Search for ...">
                            </div>
                            <div class="col-xxl-2 col-lg-6">
                                <select class="form-control select2" wire:model="filterGroup">
                                    <option>Group</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xxl-2 col-lg-4">
                                <select class="form-control select2" wire:model="filterPosition">
                                    <option>Position</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xxl-2 col-lg-4">
                                <select class="form-control select2" wire:model="filterSupervisor">
                                    <option>Supervisor</option>
                                    @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xxl-2 col-lg-4">
                                <input type="date" class="form-control" placeholder="Select date"
                                    wire:model="filterDate">
                            </div>
                            <div class="col-xxl-2 col-lg-4 d-flex gap-2 align-items-center justify-content-center">
                                <button type="button" class="btn btn-soft-secondary" wire:click="filter"><i
                                        class="mdi mdi-filter-outline align-middle"></i> Filter</button>
                                <button type="button" class="btn btn-soft-danger" wire:click="resetFilter"><i
                                        class="mdi mdi-close align-middle"></i> Reset Filter</button>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        @foreach ($activities as $activity)
            <div class="col-md-3">
                @livewire('activity.activity-item', ['activity' => $activity, 'number' => $loop->iteration], key($activity->id))
            </div>
        @endforeach

        <div class="col-lg-12">
            {{ $activities->links() }}
        </div>
    </div>
</div>
