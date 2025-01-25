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
                                <option value="{{ $group->id }}">{{ $group->name }} | {{ $group->supervisor->name }}</option>
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
                                <option value="{{ $shift->id }}">{{ $shift->name }} {{ \Carbon\Carbon::parse($shift->day_of_week)->translatedFormat('l') }}</option>
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
                                <option selected value="">-- Select Time --</option>
                                <option value="in">09:00 - 11:00 | 21:00 - 23:00</option>
                                <option value="in_break">14:00 - 16:00 | 02:00 - 04:00</option>
                                <!-- <option value="out">Out</option> -->
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
                                    <th width="50%">Employee Name</th>
                                    <th>Is Present</th>
                                    <th>Notes</th>
                                </thead>
                                <tbody class="justify-content-center align-middle">
                                    <tr class="table-warning">
                                        <td>Select All</td>
                                        <td colspan="2">
                                            <button class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                                wire:click="selectAll" type="button">
                                                @if(!$select_all) Select All @else Unselect All @endif
                                            </button>
                                        </td>
                                    </tr>
                                    @empty(!$employees)
                                    @foreach ($employees as $employee)
                                    <tr class="align-middle">
                                        <td>{{ $employee->id }} | {{ $employee->name }} | {{ $employee->group?->name }}</td>
                                        <td class="square-switch">
                                            <input type="checkbox" class="is_presents" id="is_presents_{{ $employee->id }}"
                                                switch="none" wire:model.live="is_presents.{{ $employee->id }}"
                                                value="1">
                                            <label for="is_presents_{{ $employee->id }}" data-on-label="Yes"
                                                data-off-label="No"></label>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" {{ isset($is_presents[$employee->id]) && $is_presents[$employee->id] ? 'disabled' : '' }} wire:model.live="notes.{{ $employee->id }}">
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

        })
    </script>
    @endpush
</div>