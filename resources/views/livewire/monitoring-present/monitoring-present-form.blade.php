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
                            <select class="form-select" id="group_id" wire:model="group_id">
                                <option selected value="">-- Select Group --</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>

                            <label for="search">Select Group</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="shift_id" wire:model="shift_id">
                                <option selected value="">-- Select Shift --</option>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                @endforeach
                            </select>

                            <label for="shift_id">Select Shift</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="search" wire:model.live="search">
                            <label for="search">Search Name, ID</label>
                        </div>

                        <div style="height: 600px; overflow-y: scroll">
                            <table class="table table-borderless table-striped align-middle table-sm">
                                <thead>
                                    <th width="80%">Employee Name</th>
                                    <th>Is Present</th>
                                </thead>
                                <tbody>
                                    @empty(!$employees)
                                        @foreach ($employees as $employee)
                                            <tr class="align-middle">
                                                <td>{{ $employee->id }} | {{ $employee->name }}</td>
                                                <td class="square-switch">
                                                    <input type="checkbox" id="is_presents_{{ $employee->id }}"
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
            })
        </script>
    @endpush
</div>
