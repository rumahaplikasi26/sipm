<div>

    @livewire('component.layout.breadcrumb', ['breadcrumbs' => [['name' => 'Dashboard']]], key('breadcrumb-component'))

    @can('dashboard.index')
        <div class="d-flex justify-content-end gap-2">
            <div class="mb-3">
                <label for="date">Filter Date</label>
                <input type="date" class="form-control" wire:model.live="date">
            </div>
        </div>
  
        @livewire('dashboard.attendance-stats', ['date' => $date], key('attendance-stats'))
        @livewire('dashboard.attendance-stats-night', ['date' => $date], key('attendance-stats-night'))
    
        @livewire('dashboard.monitoring-general',['date' => $date], key('monitoring-general'))
        @livewire('dashboard.monitoring-supervisor',['date' => $date], key('monitoring-supervisor'))
    @endcan


</div>
