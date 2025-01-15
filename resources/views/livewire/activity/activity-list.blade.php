<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="d-flex justify-content-end">
                <div class="flex-shrink-0">
                    <a href="#!" class="btn btn-primary" wire:click="$dispatch('showForm')">Add New Activity</a>
                    <a href="#!" class="btn btn-light" wire:click="$dispatch('refreshIndex')"><i class="mdi mdi-refresh"></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card job-filter">
                <div class="card-body">
                    <form action="javascript:void(0);">
                        <div class="row g-3">
                            <div class="col-xxl-2 col-lg-6">
                                <input type="search" class="form-control" id="searchInput" wire:model="search"
                                    placeholder="Search for ...">
                            </div>
                            <div class="col-xxl-2 col-lg-6">
                                <select class="form-control select2" wire:model="filterGroup">
                                    <option>Group</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xxl-2 col-lg-4">
                                <select class="form-control select2" wire:model="filterPosition">
                                    <option>Position</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xxl-2 col-lg-4">
                                <select class="form-control select2" wire:model="filterSupervisor">
                                    <option>Supervisor</option>
                                    @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xxl-2 col-lg-4">
                                <input type="date" class="form-control" placeholder="Select date"
                                    wire:model="filterDate">
                            </div>
                            <div class="col-xxl-2 col-lg-4 d-flex gap-2 align-items-center justify-content-center">
                                <button type="button" class="btn btn-soft-secondary" wire:click="filter"><i
                                        class="mdi mdi-filter-outline align-middle"></i> Filter</button>
                                <button type="button" class="btn btn-soft-danger" wire:click="resetFilter"><i
                                        class="mdi mdi-close align-middle"></i> Reset</button>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        @foreach ($activities as $activity)
            <div class="col-md-3 mb-3">
                @livewire('activity.activity-item', ['activity' => $activity, 'number' => $loop->iteration], key($activity->id))
            </div>
        @endforeach

        <div class="col-lg-12">
            {{ $activities->links() }}
        </div>
    </div>

    <div id="validationActivity" class="modal fade" tabindex="-1" aria-labelledby="validationActivityLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="validationActivityLabel">Validation Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate wire:submit.prevent="submitValidation">
                        <div class="mb-3">
                            <label for="status_id" class="form-label">Status</label>
                            <div class="d-flex gap-3">

                                @foreach ($statuses as $status)
                                    <div class="form-check form-radio-primary mb-3">
                                        <input class="form-check-input" type="radio" name="status_id"
                                            id="status{{ $status->id }}" wire:model="status_id"
                                            value="{{ $status->id }}">
                                        <label class="form-check-label" for="status{{ $status->id }}">
                                            {{ $status->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="btn  btn-secondary waves-effect"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="updateProgress" class="modal fade" tabindex="-1" aria-labelledby="updateProgressLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProgressLabel">Validation Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate wire:submit.prevent="submitProgress">
                        <div class="range-wrap">
                            <div class="range-value" id="rangeV"></div>
                            <input id="range" type="range" min="0" max="100" value="50"
                                step="1" class="@error('progress') is-invalid @enderror" wire:model="progress">

                            @error('progress')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="btn  btn-secondary waves-effect"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    @push('styles')
        <style>
            input[type=range] {
                -webkit-appearance: none;
                margin: 20px 0;
                width: 100%;
            }

            input[type=range]:focus {
                outline: none;
            }

            input[type=range]::-webkit-slider-runnable-track {
                width: 100%;
                height: 4px;
                cursor: pointer;
                animate: 0.2s;
                background: #03a9f4;
                border-radius: 25px;
            }

            input[type=range]::-webkit-slider-thumb {
                height: 20px;
                width: 20px;
                border-radius: 50%;
                background: #fff;
                box-shadow: 0 0 4px 0 rgba(0, 0, 0, 1);
                cursor: pointer;
                -webkit-appearance: none;
                margin-top: -8px;
            }

            input[type=range]:focus::-webkit-slider-runnable-track {
                background: #03a9f4;
            }

            .range-wrap {
                width: 100%;
                position: relative;
            }

            .range-value {
                position: absolute;
                top: -50%;
            }

            .range-value span {
                width: 30px;
                height: 24px;
                line-height: 24px;
                text-align: center;
                background: #03a9f4;
                color: #fff;
                font-size: 12px;
                display: block;
                position: absolute;
                left: 50%;
                transform: translate(-50%, 0);
                border-radius: 6px;
            }

            .range-value span:before {
                content: "";
                position: absolute;
                width: 0;
                height: 0;
                border-top: 10px solid #03a9f4;
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                top: 100%;
                left: 50%;
                margin-left: -5px;
                margin-top: -1px;
            }
        </style>
    @endpush

    @push('js')
        <script>
            document.addEventListener('livewire:init', function() {

                Livewire.on('showFormValidation', () => {
                    $('#validationActivity').modal('show');
                });

                Livewire.on('hideFormValidation', () => {
                    $('#validationActivity').modal('hide');
                });

                Livewire.on('showFormProgress', () => {
                    $('#updateProgress').modal('show');

                    const
                        range = document.getElementById('range'),
                        rangeV = document.getElementById('rangeV'),
                        setValue = () => {
                            const
                                newValue = Number((range.value - range.min) * 100 / (range.max - range.min)),
                                newPosition = 10 - (newValue * 0.2);
                            rangeV.innerHTML = `<span>${range.value}</span>`;
                            rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
                        };
                    document.addEventListener("DOMContentLoaded", setValue);
                    range.addEventListener('input', setValue);
                });

                Livewire.on('hideFormProgress', () => {
                    $('#updateProgress').modal('hide');
                });
            })
        </script>
    @endpush
</div>
