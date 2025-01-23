<div class="card task-box h-100 d-flex flex-column" id="uptask-2">
    <div class="card-body d-flex flex-column">
        <!-- Header Section -->
        <div class="mb-1">
            <div class="float-end ms-2">
                @if ($activity->status_id != null)
                    <span
                        class="badge {{ $activity->status->bg_color }} font-size-12">{{ $activity->status->name }}</span>
                @endif
                <span class="badge badge-soft-{{ $activity->progress_color }} font-size-12">{{ $activity->progress }} %</span>
            </div>
            <div>
                <h5 class="font-size-15">
                    <a href="javascript: void(0);" class="text-dark" id="task-name">{{ $activity->scope?->name }}</a>
                </h5>
                <p class="text-muted d-flex flex-column gap-1">
                    {{ $activity->created_at->format('d F Y H:i') }}
                    <span class="badge badge-soft-primary font-size-16">Group: {{ $activity->group->name }}</span>
                    <span class="badge badge-soft-info font-size-12">Position: {{ $activity->position->name }}</span>
                </p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="mb-3 text-muted">
            {{ $activity->description }}
        </div>

        <div class="d-flex flex-wrap justify-content-between gap-2">
            <!-- Button Section - Fixed at Bottom -->
            <div class="btn-group btn-group-sm flex-shrink-0">
                <button type="button" class="btn btn-light dropdown-toggle w-100" data-bs-toggle="dropdown"
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
                            <p class="text-muted mb-0">{{ $activity->total_estimate }} {{ $activity->type_estimate }}
                            </p>
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

            <div class="flex-grow-1">
                @can('activity.validation.update')
                    <a class="btn btn-success btn-sm w-100"
                        wire:click="$dispatch('show-modal-validation', {activity_id: {{ $activity->id }}})"
                        href="javascript: void(0);">
                        <i class="mdi mdi-check"></i> Validasi Activity</a>
                @endcan
            </div>

            <div class="flex-grow-1">
                @can('activity.progress.update')
                    <a class="btn btn-warning btn-sm w-100"
                        wire:click="$dispatch('show-modal-progress', {activity_id: {{ $activity->id }}})"
                        href="javascript: void(0);">
                        <i class="mdi mdi-progress-clock"></i> Update Progress</a>
                @endcan
            </div>

            <div class="flex-grow-1">
                @can('activity.edit')
                    <a class="btn btn-info btn-sm w-100"
                        wire:click="$dispatch('show-modal-actual-date', {activity_id: {{ $activity->id }}})"
                        href="javascript: void(0);">
                        <i class="mdi mdi-calendar"></i> Update Actual Date Activity</a>
                @endcan
            </div>

            <div class="flex-grow-1">
                @can('activity.issue.update')
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm w-100"
                        wire:click="$dispatch('show-canvas-dependency',{activity_id: {{ $activity->id }}})">
                        <i class="mdi mdi-bug"></i> Manage Dependency</a>
                @endcan
            </div>

            <div class="flex-grow-1">
                @can('activity.destroy')
                    <a class="btn btn-danger btn-sm w-100" wire:click="confirmDelete" href="javascript: void(0);">
                        <i class="mdi mdi-delete"></i> Delete Activity</a>
                @endcan
            </div>
        </div>
    </div>
</div>
