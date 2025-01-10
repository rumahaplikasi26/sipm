<div class="row">
    @foreach ($groups as $group)
        <div class="col-xl-3 col-sm-4">
            @livewire('group.group-item', ['group' => $group], key($group->id))
        </div>
    @endforeach

    <div class="col-12">
        {{ $groups->links() }}
    </div>
</div>
