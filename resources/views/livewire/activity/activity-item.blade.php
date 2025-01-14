<div class="card task-box h-100 d-flex flex-column" id="uptask-2">
    <div class="card-body d-flex flex-column">
        <!-- Header Section -->
        <div class="mb-3">
            <div class="dropdown float-end">
                <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical m-0 text-muted h4"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item edittask-details" wire:click="confirmProgress" href="javascript: void(0);">
                        <i class="mdi mdi-progress-clock"></i> Update Progress</a>
                    <a href="javascript:void(0);" class="dropdown-item edittask-details"
                        wire:click="$dispatch('show-canvas-dependency',{activity_id: {{ $activity->id }}})">
                        <i class="mdi mdi-bug"></i> Manage Dependency</a>
                    <a class="dropdown-item edittask-details" wire:click="confirmDelete" href="javascript: void(0);">
                        <i class="mdi mdi-delete"></i> Delete</a>
                </div>
            </div>
            <div class="float-end ms-2">
                <span class="badge badge-soft-primary font-size-12" id="task-status">{{ $activity->progress }} %</span>
            </div>
            <div>
                <h5 class="font-size-15">
                    <a href="javascript: void(0);" class="text-dark" id="task-name">{{ $activity->title }}</a>
                </h5>
                <p class="text-muted">{{ $activity->date }}</p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="flex-grow-1">
            <ul class="ps-3 mb-3 text-muted" id="task-desc">
                <li class="py-1">Group: {{ $activity->group->name }}</li>
                <li class="py-1">Position: {{ $activity->position->name }}</li>
                <li class="py-1">Scope: {{ $activity->scope->name }}</li>
            </ul>
        </div>

        <!-- Button Section - Fixed at Bottom -->
        <div class="btn-group btn-group-sm mt-auto">
            <button type="button" class="btn btn-light dropdown-toggle col-12" data-bs-toggle="dropdown"
                aria-haspopup="false" aria-expanded="false">
                Other Information <i class="mdi mdi-chevron-down"></i>
            </button>
            <div class="dropdown-menu p-4">
                <div class="d-block">
                    @livewire(
                        'widget.chart.radial-bar',
                        [
                            'chart_id' => 'chart-' . $activity->id,
                            'series' => [$activity->progress],
                        ],
                        key('chart-' . $activity->id)
                    )
                </div>

                <div class="d-flex flex-lg-row flex-column justify-content-between gap-3 text-center">
                    <div>
                        <h5 class="text-truncate font-size-14">Forecast Date</h5>
                        <p class="text-muted mb-0">{{ $activity->forecast_date }}</p>
                    </div>
                    <div>
                        <h5 class="text-truncate font-size-14">Plan Date</h5>
                        <p class="text-muted mb-0">{{ $activity->plan_date }}</p>
                    </div>
                    <div>
                        <h5 class="text-truncate font-size-14">Actual Date</h5>
                        <p class="text-muted mb-0">{{ $activity->actual_date }}</p>
                    </div>
                </div>

                <div class="d-flex flex-lg-row flex-column justify-content-center gap-3 mt-4 text-center">
                    <div>
                        <h5 class="text-truncate font-size-14">Supervisor</h5>
                        <p class="text-muted mb-0">{{ $activity->supervisor->name }}</p>
                    </div>
                    <div>
                        <h5 class="text-truncate font-size-14">Estimate Time</h5>
                        <p class="text-muted mb-0">{{ $activity->total_estimate }} {{ $activity->type_estimate }}</p>
                    </div>
                </div>

                @if ($activity->issues->count() > 0)
                    <div class="mt-4">
                        <div>
                            <p class="text-muted">ISSUES</p>
                            <ul class="list-unstyled">
                                @foreach ($activity->issues as $issue)
                                    <li>
                                        <a href="javascript: void(0);" class="d-block">
                                            <i class="mdi mdi-chevron-right me-1"></i>
                                            {{ $issue->categoryDependency->name }}</a>
                                        <p class="ms-4 text-muted font-size-8">{{ $issue->description }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
