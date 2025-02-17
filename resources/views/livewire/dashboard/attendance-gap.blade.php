<div>
    <div class="row">
        <h4 class="card-title">Attendance Gap Date {{ $dateString }} {{ $reference->name }}</h4>
        <div class="col-md-12">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div>
                                <p class="text-muted text-truncate mb-2">Not Checkout</p>
                                <h5 class="mb-0">{{ $totalGapCheckInOnly }}</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <p class="text-muted text-truncate mb-2">Not Checkin</p>
                                <h5 class="mb-0">{{ $totalGapCheckOutOnly }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
