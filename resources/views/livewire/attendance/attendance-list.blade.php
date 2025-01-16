<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card job-filter">
                <div class="card-body">
                    <form action="javascript:void(0);">
                        <div class="row g-3">
                            <div class="col-xxl-2 col-lg-6 form-floating">
                                <input type="text" class="form-control" id="searchInput" wire:model="search" placeholder="Enter Keyword">
                                <label for="searchInput">Search ...</label>
                            </div>
                            <div class="col-xxl-2 col-lg-6 form-floating">
                                <select class="form-control select2" id="selectGroup" wire:model="filterGroup">
                                    <option selected>-- Select Group --</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                                <label for="selectGroup">Filter Select Group</label>
                            </div>
                            <div class="col-xxl-2 col-lg-4 form-floating">
                                <select class="form-control select2" id="selectPosition" wire:model="filterPosition">
                                    <option selected>-- Select Position --</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                                <label for="selectPosition">Filter Select Position</label>
                            </div>
                            <div class="col-xxl-2 col-lg-4 form-floating">
                                <input type="date" class="form-control" id="filterStartDate" wire:model="filterStartDate">
                                <label for="filterStartDate">Filter Start Date</label>
                            </div>
                            <div class="col-xxl-2 col-lg-4 form-floating">
                                <input type="date" class="form-control" id="filterEndDate" wire:model="filterEndDate">
                                <label for="filterEndDate">Filter End Date</label>
                            </div>
                            <div class="col-xxl-2 col-lg-4">
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="button" class="btn btn-soft-secondary waves-effect waves-light w-sm" wire:click="filter">
                                        <i class="mdi mdi-filter-outline d-block font-size-16"></i> Filter
                                    </button>
                                    <button type="button" class="btn btn-soft-danger waves-effect waves-light w-sm" wire:click="resetFilter">
                                        <i class="mdi mdi-refresh d-block font-size-16"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Group</th>
                                    <th scope="col">Position</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attendance->date }}</td>
                                        <td>{{ $attendance->time }}</td>
                                        <td>{{ $attendance->employee->name }}</td>
                                        <td>{{ $attendance->employee?->group?->name }}</td>
                                        <td>{{ $attendance->employee?->group?->name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
