<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="d-flex justify-content-end">
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-success waves-effect btn-label waves-light"
                        wire:click="exportExcel" wire:loading.attr="disabled"><i class="fas fa-file-excel label-icon"></i> Excel</button>
                    <button type="button" class="btn btn-danger waves-effect btn-label waves-light" wire:click="exportPdf" wire:loading.attr="disabled"><i
                            class="fas fa-file-pdf label-icon"></i> PDF</button>
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
                                <th scope="col">Date</th>
                                <th scope="col">Title</th>
                                <th scope="col">Group</th>
                                <th scope="col">Position</th>
                                <th scope="col">Scope</th>
                                <th scope="col">Estimate Time</th>
                                <th scope="col">Date Work</th>
                                <th scope="col">Progress AVG</th>
                                <th scope="col">Supervisor</th>
                                <th scope="col">Dependency</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $activity['id'] }}</td>
                                <td>{{ $activity['date'] }}</td>
                                <td>{{ $activity['title'] }}</td>
                                <td>{{ $activity['group']['name'] }}</td>
                                <td>{{ $activity['position']['name'] }}</td>
                                <td>
                                    @if (count($activity['details']) > 0)
                                    <ul>
                                        @foreach ($activity['details'] as $detail)
                                        <li>{{ $detail['scope']['name'] }}: {{ $detail['progress'] }}%</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </td>
                                <td>{{ $activity['total_estimate'] }} {{ $activity['type_estimate'] }}</td>
                                <td>
                                    <p>Forecast: {{ $activity['forecast_date'] }}</p>
                                    <p>Plan: {{ $activity['plan_date'] }}</p>
                                    <p>Actual: {{ $activity['actual_date'] }}</p>
                                </td>
                                <td>{{ $activity['progress'] }}</td>
                                <td>{{ $activity['supervisor']['name'] }}</td>
                                <td>
                                    @if (count($activity['issues']) > 0)
                                    <ul>
                                        @foreach ($activity['issues'] as $dependency)
                                        <li>{{ $dependency['category_dependency']['name'] }}: {{ $dependency['description'] }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
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