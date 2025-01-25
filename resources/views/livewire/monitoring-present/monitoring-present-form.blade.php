<div>
    <div id="addMonitoringPresent" class="modal fade" tabindex="-1" aria-labelledby="addMonitoringPresentLabel"
        data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMonitoringPresentLabel">Add Monitoring Present</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);" wire:submit.prevent="submitMonitoringPresent">

                        <div class="form-floating mb-3">
                            <select class="form-select @error('group_id') is-invalid @enderror" id="group_id" wire:model.live="group_id">
                                <option selected value="">-- Select Group --</option>
                                @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>

                            <label for="search">Select Group</label>

                            @error('group_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select @error('shift_id') is-invalid @enderror" id="shift_id" wire:model="shift_id">
                                <option selected value="">-- Select Shift --</option>
                                @foreach ($shiftForms as $shift)
                                <option value="{{ $shift->id }}">{{ $shift->name }} {{ $shift->day_of_week }}</option>
                                @endforeach
                            </select>

                            <label for="shift_id">Select Shift</label>

                            @error('shift_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select @error('type') is-invalid @enderror" id="type" wire:model="type">
                                <option selected value="">-- Select Type --</option>
                                <option value="in">In</option>
                                <option value="in_break">In Break</option>
                                <option value="out">Out</option>
                            </select>
                            <label for="type">Select Type</label>


                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="search" wire:model.live="search">
                            <label for="search">Search Name, ID</label>
                        </div>

                        <div style="height: 600px; overflow-y: scroll">
                            <table class="table table-borderless align-middle table-sm">
                                <thead>
                                    <th width="80%">Employee Name</th>
                                    <th>Is Present</th>
                                </thead>
                                <tbody class="justify-content-center align-middle">
                                    <tr class="table-warning">
                                        <td>Select All</td>
                                        <td class="square-switch">
                                            <input type="checkbox" id="select_all"
                                                switch="none" wire:model="select_all">
                                            <label for="select_all" data-on-label="All"
                                                data-off-label="All"></label>
                                        </td>
                                    </tr>
                                    @empty(!$employees)
                                    @foreach ($employees as $employee)
                                    <tr class="align-middle">
                                        <td>{{ $employee->id }} | {{ $employee->name }} | {{ $employee->group?->name }}</td>
                                        <td class="square-switch">
                                            <input type="checkbox" class="is_presents" id="is_presents_{{ $employee->id }}"
                                                switch="none" wire:model="is_presents.{{ $employee->id }}"
                                                value="1">
                                            <label for="is_presents_{{ $employee->id }}" data-on-label="Yes"
                                                data-off-label="No"></label>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endempty
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex gap-2 justify-content-end mt-4">
                            <button type="button" class="btn  btn-secondary waves-effect"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    @push('js')
    <script>
        document.addEventListener('livewire:init', function() {

            Livewire.on('showModalAddMonitoring', () => {
                $('#addMonitoringPresent').modal('show');
            });

            Livewire.on('hideModalAddMonitoring', () => {
                $('#addMonitoringPresent').modal('hide');
            });

            $('#select_all').click(function() {
                // window.alert(this.checked);
                if (this.checked) {
                    $('.is_presents').prop('checked', true).trigger('change');
                } else {
                    $('.is_presents').prop('checked', false).trigger('change');
                }
            })
        })
    </script>
    @endpush
</div>