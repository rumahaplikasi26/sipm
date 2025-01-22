<div>
    @livewire('component.layout.breadcrumb', ['breadcrumbs' => [['name' => 'Report Attendance', 'url' => route('activity.report')]]], key('breadcrumb'))

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
                                <input type="date"
                                    class="form-control @error('filterStartDate') is-invalid @enderror"
                                    id="filterStartDate" wire:model="filterStartDate">
                                <label for="filterStartDate">Filter Start Date</label>

                                @error('filterStartDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-xxl-2 col-lg-4 form-floating">
                                <input type="date" class="form-control @error('filterEndDate') is-invalid @enderror"
                                    id="filterEndDate" wire:model="filterEndDate">
                                <label for="filterEndDate">Filter End Date</label>

                                @error('filterEndDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-xxl-2 col-lg-4">
                                <div class="d-flex gap-2">
                                    <button type="button"
                                        class="btn btn-soft-secondary waves-effect waves-light flex-grow-1"
                                        wire:click="preview">
                                        <i class="mdi mdi-filter-outline d-block font-size-16"></i> Preview
                                    </button>
                                    <button type="button"
                                        class="btn btn-soft-danger waves-effect waves-light flex-grow-1"
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

    @livewire('report-attendance.report-attendance-preview', key('preview'))
</div>
