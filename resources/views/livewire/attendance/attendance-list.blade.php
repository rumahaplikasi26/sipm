<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card job-filter">
                <div class="card-body">
                    <form action="javascript:void(0);">
                        <div class="row g-3">
                            <div class="col-xxl-2 col-lg-6 form-floating">
                                <select class="form-select" id="selectEmployee" wire:model="filterEmployee">
                                    <option selected value="">-- Select Employee --</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                                <label for="selectEmployee">Filter Select Employee</label>
                            </div>
                            <div class="col-xxl-2 col-lg-6 form-floating">
                                <select class="form-select" id="selectGroup" wire:model="filterGroup">
                                    <option selected value="">-- Select Group --</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                                <label for="selectGroup">Filter Select Group</label>
                            </div>
                            <div class="col-xxl-2 col-lg-4 form-floating">
                                <select class="form-select" id="selectPosition" wire:model="filterPosition">
                                    <option selected value="">-- Select Position --</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                                <label for="selectPosition">Filter Select Position</label>
                            </div>
                            <div class="col-xxl-2 col-lg-4 form-floating">
                                <input type="date" class="form-control" id="filterStartDate"
                                    wire:model="filterStartDate">
                                <label for="filterStartDate">Filter Start Date</label>
                            </div>
                            <div class="col-xxl-2 col-lg-4 form-floating">
                                <input type="date" class="form-control" id="filterEndDate"
                                    wire:model="filterEndDate">
                                <label for="filterEndDate">Filter End Date</label>
                            </div>
                            <div class="col-xxl-2 col-lg-4">
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="button" class="btn btn-soft-secondary waves-effect waves-light"
                                        wire:click="filter">
                                        <i class="mdi mdi-filter-outline d-block font-size-16"></i> Filter
                                    </button>
                                    <button type="button" class="btn btn-soft-danger waves-effect waves-light"
                                        wire:click="resetFilter">
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

    <div class="row gy-2 gx-3 mb-2 align-items-center">
        <div class="col-sm-auto">
            <select class="form-select" id="selectLimit" wire:model.live="perPage">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
            </select>
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
                                    <th scope="col">Employee ID</th>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Group</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Machine SN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attendance->employee_id }}</td>
                                        <td>{{ $attendance->employee->name }}</td>
                                        <td>{{ $attendance->dateString }}</td>
                                        <td>{{ $attendance->time }}</td>
                                        <td>{{ $attendance->employee?->group?->name }}</td>
                                        <td>{{ $attendance->employee?->position?->name }}</td>
                                        <td>
                                            <span
                                                class="badge badge-soft-{{ $attendance->config ? $attendance->config->bgColor . ' ' . $attendance->config->textColor : 'danger' }}">
                                                {{ $attendance->config ? $attendance->config->name : 'NULL' }}
                                            </span>
                                        </td>
                                        <td>{{ $attendance->machine_sn }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No Data</td>
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
