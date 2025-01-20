<div>
    <div id="updateProgress" class="modal fade" tabindex="-1" aria-labelledby="updateProgressLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProgressLabel">Update Progress</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate wire:submit.prevent="submitProgress">

                        <table class="table table-borderless table-striped align-middle">
                            <thead>
                                <th width="80%">Scope</th>
                                <th>Progress</th>
                            </thead>
                            <tbody>
                                @empty(!$details)
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>{{ $detail['scope']['name'] }}</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    wire:model="updateProgress.{{ $detail['id'] }}"
                                                    value="{{ $detail['progress'] }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

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

        @push('js')
            <script>
                document.addEventListener('livewire:init', function() {

                    Livewire.on('showFormProgress', () => {
                        $('#updateProgress').modal('show');
                    });

                    Livewire.on('hideFormProgress', () => {
                        $('#updateProgress').modal('hide');
                    });
                })
            </script>
        @endpush
    </div>
