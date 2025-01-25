<div class="card mini-stats-wid">
    <div class="card-body">
        <div class="d-flex">
            <div class="flex-grow-1">
                <p class="text-muted fw-medium">{{ $title }}</p>
                <h4 class="mb-0" wire:loading.remove>{{ $value }}</h4>
                <h6 class="mb-0" wire:loading wire:loading.class="text-muted">Loading...</h6>
            </div>

            <div class="flex-shrink-0 align-self-center">
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                    <span class="avatar-title">
                        <i class="bx bx-copy-alt font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
