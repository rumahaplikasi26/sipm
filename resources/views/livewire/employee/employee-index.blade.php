<div>
    @livewire('component.layout.breadcrumb', ['breadcrumbs' => [['name' => 'Master Data', 'url' => '/'], ['name' => 'Employee', 'url' => route('master.employees')]]], key('breadcrumb'))

    <div class="row">
        <div class="col-lg-9">
            @livewire('employee.employee-list')
        </div>

        <div class="col-lg-3">
            @livewire('employee.employee-form', key('employee-form'))
            @livewire('employee.employee-import', key('employee-import'))
        </div>
    </div>

</div>
