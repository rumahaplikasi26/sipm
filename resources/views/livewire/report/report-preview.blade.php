<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="d-flex justify-content-end">
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-success waves-effect btn-label waves-light"
                        wire:click="exportExcel" wire:loading.attr="disabled"><i class="fas fa-file-excel label-icon"></i>
                        Excel</button>
                    <button type="button" class="btn btn-danger waves-effect btn-label waves-light"
                        wire:click="exportPdf" wire:loading.attr="disabled"><i class="fas fa-file-pdf label-icon"></i>
                        PDF</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Activity</h4>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Scope</th>
                                <th scope="col">Group</th>
                                <th scope="col">Position</th>
                                <th scope="col">Estimate Time</th>
                                <th scope="col">Date Work</th>
                                <th scope="col">Progress %</th>
                                <th scope="col">Supervisor</th>
                                <th scope="col">Dependency</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td>{{ $activity['id'] }}</td>
                                    <td>{{ $activity['scope']['name'] }}</td>
                                    <td>{{ $activity['group']['name'] }}</td>
                                    <td>{{ $activity['position']['name'] }}</td>
                                    <td>{{ $activity['total_estimate'] }} Day</td>
                                    <td>
                                        <ul>
                                            <li>Forecast: {{ $activity['forecast_date'] }}</li>
                                            <li>Plan: {{ $activity['plan_date'] }}</li>
                                            <li>Actual: {{ $activity['actual_date'] ?? '-' }}</li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul style="list-style: none;padding: 0">
                                            @foreach ($activity['history_progress'] as $history)
                                                <li>{{ $history['date'] }}: {{ $history['percentage'] }}%</li>
                                            @endforeach
                                            <li class="fw-bold">Total: {{ $activity['progress'] }}%</li>
                                        </ul>
                                    </td>
                                    <td>{{ $activity['supervisor']['name'] }}</td>
                                    <td>
                                        @if (count($activity['issues']) > 0)
                                            <ul>
                                                @foreach ($activity['issues'] as $dependency)
                                                    <li>{{ $dependency['category_dependency']['name'] }}
                                                        {{ $dependency['percentage_dependency'] }}%:
                                                        {{ $dependency['description'] }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $activity['status']['bg_color'] }}">{{
                                            $activity['status']['name'] }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
