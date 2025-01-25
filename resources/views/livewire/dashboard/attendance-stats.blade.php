<div>
    <div class="row">
        <h4 class="card-title">Attendance Stats</h4>
        <div class="col-md-3">
            @livewire('component.widget.card-mini', ['title' => 'Total IN', 'value' => $totalIN], key('total-in'))
        </div>

        <div class="col-md-3">
            @livewire('component.widget.card-mini', ['title' => 'Total OUT', 'value' => $totalOUT], key('total-out'))
        </div>

        <div class="col-md-3">
            @livewire('component.widget.card-mini', ['title' => 'Total Break IN', 'value' => $totalBreakIn], key('total-break-in'))
        </div>

        <div class="col-md-3">
            @livewire('component.widget.card-mini', ['title' => 'Total Break OUT', 'value' => $totalBreakOut], key('total-break-out'))
        </div>
    </div>
</div>
