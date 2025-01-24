<div>
    <div class="row">
        <div class="col-md-3">
            @livewire('component.widget.card-mini', ['title' => 'Total IN', 'value' => $totalIN], key('total-in'))
        </div>

        <div class="col-md-3">
            @livewire('component.widget.card-mini', ['title' => 'Total OUT', 'value' => $totalOUT], key('total-out'))
        </div>

        <div class="col-md-3">
            @livewire('component.widget.card-mini', ['title' => 'Total BreakIn', 'value' => $totalBreakIn], key('total-break-in'))
        </div>

        <div class="col-md-3">
            @livewire('component.widget.card-mini', ['title' => 'Total totalBreakOut', 'value' => $totalBreakOut], key('total-break-out'))
        </div>
    </div>
</div>
