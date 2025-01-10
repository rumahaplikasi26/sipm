<div class="row">
    @foreach ($users as $user)
        <div class="col-xl-4 col-sm-6">
            @livewire('user.user-item', ['user' => $user], key($user->id))
        </div>
    @endforeach

    <div class="col-12">
        {{ $users->links() }}
    </div>
</div>
