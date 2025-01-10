<div>
    @livewire('component.layout.breadcrumb', ['breadcrumbs' => [['name' => 'Master Data', 'url' => '/'], ['name' => 'Group', 'url' => route('master.groups')]]], key('breadcrumb'))

    <div class="row">
        <div class="col-lg-10">
            @livewire('group.group-list')
        </div>

        <div class="col-lg-2">
            @livewire('group.group-form', key('group-form'))
        </div>
    </div>

</div>
