<div>
    @livewire('component.layout.breadcrumb', ['breadcrumbs' => [['name' => 'Report Activity', 'url' => route('activity.report')]]], key('breadcrumb'))

    <div class="row">

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

    @if (count($activities) > 0)
        @livewire('report.report-preview', ['activities' => $activities], key('report-preview'))
    @endif

</div>
