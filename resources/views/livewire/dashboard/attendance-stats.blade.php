<div>
    <div class="row">
        <h4 class="card-title">Attendance Stats Date {{ $dateString }} {{ $shift->name }}</h4>
        <div class="col-md-3">
            @livewire('component.widget.card-mini', [
            'title' => 'IN ('.$shift->start_adjustment.' - '.$shift->break_start_time.')',
            'value' => $totalIN],
            key('total-in')
            )
        </div>

        <div class="col-md-3">
            @livewire('component.widget.card-mini', [
            'title' => 'OUT ('.$shift->break_end_time.' - '.$shift->end_adjustment.')',
            'value' => $totalOUT],
            key('total-out')
            )
        </div>

        <div class="col-md-3">
            @livewire('component.widget.card-mini', [
            'title' => 'Break IN ('.$shift->break_start_time.' - '.$shift->break_end_time.')',
            'value' => $totalBreakIn],
            key('total-break-in')
            )
        </div>

        <div class="col-md-3">
            @livewire('component.widget.card-mini', [
            'title' => 'Break OUT ('.$shift->break_end_time.' - '.$shift->end_time.')',
            'value' => $totalBreakOut], key('total-break-out')
            )
        </div>
    </div>
</div>