<div>
    <div class="row">
        <h4 class="card-title">Attendance Status Date {{ $dateString }} {{ $reference->name }}</h4>
        <div class="col-md-3">
            @livewire(
                'component.widget.card-mini',
                [
                    'title' => 'IN (' . $reference->start_adjustment . ' - ' . $reference->break_start_time . ')',
                    'value' => $totalIN,
                    'clickToOpenModal' => 'attendance-status-modal',
                    'data' => $employeesIn
                ],
                key('total-in')
            )
        </div>

        <div class="col-md-3">
            @livewire(
                'component.widget.card-mini',
                [
                    'title' => 'OUT (' . $reference->end_time . ' - ' . $reference->end_adjustment . ')',
                    'value' => $totalOUT,
                    'clickToOpenModal' => 'attendance-status-modal',
                    'data' => $employeesOut
                ],
                key('total-out')
            )
        </div>

        <div class="col-md-3">
            @livewire(
                'component.widget.card-mini',
                [
                    'title' => 'Break IN (' . $reference->break_start_time . ' - ' . $reference->break_end_time . ')',
                    'value' => $totalBreakIn,
                    'clickToOpenModal' => 'attendance-status-modal',
                    'data' => $employeesBreakIn
                ],
                key('total-break-in')
            )
        </div>

        <div class="col-md-3">
            @livewire(
                'component.widget.card-mini',
                [
                    'title' => 'Break OUT (' . $reference->break_end_time . ' - ' . $reference->end_time . ')',
                    'value' => $totalBreakOut,
                    'clickToOpenModal' => 'attendance-status-modal',
                    'data' => $employeesBreakOut
                ],
                key('total-break-out')
            )
        </div>
    </div>
</div>
