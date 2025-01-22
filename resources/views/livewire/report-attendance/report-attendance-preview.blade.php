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
                    <h4 class="card-title mb-5">Preview Attendance</h4>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Name</th>
                                @empty(!$employees)
                                    @foreach ($employees->first()['attendance'] ?? [] as $date => $status)
                                        <th>{{ \Carbon\Carbon::parse($date)->format('d/m') }}</th>
                                    @endforeach
                                @endempty
                            </tr>
                        </thead>
                        <tbody>
                            @empty(!$employees)
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee['employee_id'] }}</td>
                                        <td>{{ $employee['name'] }}</td>
                                        @foreach ($employee['attendance'] as $date => $timeRange)
                                            <td>{{ $timeRange }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endempty
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
