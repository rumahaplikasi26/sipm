<div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Attendance Per Division {{ $dateString }} {{ $shift->name }}</h4>
            <div class="row">
                <div class="col-12" wire:loading>
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 table-responsive" wire:loading.remove>
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr class="text-center align-middle">
                                <th>NO</th>
                                <th>DIVISI</th>
                                <th>TOTAL IN</th>
                                <th>TOTAL OUT</th>
                                <th>TOTAL BREAK IN</th>
                                <th>TOTAL BREAK OUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalInNight = 0;
                                $totalOutNight = 0;
                                $totalBreakInNight = 0;
                                $totalBreakOutNight = 0;
                            @endphp
                            @foreach ($attendanceData as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data['division'] }}</td>
                                    <td>
                                        <a href="#"
                                            wire:click.prevent="showSupervisorData('IN', '{{ $data['division'] }}')">
                                            {{ $data['totalIn'] }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#"
                                            wire:click.prevent="showSupervisorData('OUT', '{{ $data['division'] }}')">
                                            {{ $data['totalOut'] }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#"
                                            wire:click.prevent="showSupervisorData('BreakIn', '{{ $data['division'] }}')">
                                            {{ $data['totalBreakIn'] }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#"
                                            wire:click.prevent="showSupervisorData('BreakOut', '{{ $data['division'] }}')">
                                            {{ $data['totalBreakOut'] }}
                                        </a>
                                    </td>
                                </tr>

                                @php
                                    $totalInNight += $data['totalIn'];
                                    $totalOutNight += $data['totalOut'];
                                    $totalBreakInNight += $data['totalBreakIn'];
                                    $totalBreakOutNight += $data['totalBreakOut'];
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold">
                                <td colspan="2">TOTAL</td>
                                <td>{{ $totalInNight }}</td>
                                <td>{{ $totalOutNight }}</td>
                                <td>{{ $totalBreakInNight }}</td>
                                <td>{{ $totalBreakOutNight }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal untuk menampilkan data supervisor -->
    @if ($showModal)
        <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Total Per Supervisor ({{ $selectedCategory }} -
                            {{ $selectedDivision }})</h5>
                        <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6" style="overflow-y: scroll; max-height: 500px;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Supervisor</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($supervisorData)
                                            @php
                                                $totals = 0;
                                            @endphp
                                            @foreach ($supervisorData as $supervisor => $total)
                                                <tr>
                                                    <td>{{ $supervisor }}</td>
                                                    <td>
                                                        <a href="#"
                                                            wire:click.prevent="showEmployeeData('{{ $supervisor }}')">
                                                            {{ $total }}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $totals += $total;
                                                @endphp
                                            @endforeach
                                            <tr class="fw-bold">
                                                <td>Total</td>
                                                <td>{{ $totals }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6" style="overflow-y: scroll; max-height: 500px;">
                                @if ($employeeData && $selectedSupervisor)
                                    <h6>Daftar Karyawan di Supervisor: {{ $selectedSupervisor }}</h6>
                                    <table class="table table-bordered" wire:loading.remove>
                                        <thead>
                                            <tr>
                                                <th>Nama Karyawan</th>
                                                <th>Phone</th>
                                                <th>Timestamp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employeeData as $employee)
                                                <tr>
                                                    <td>{{ $employee['name'] }}</td>
                                                    <td>{{ $employee['phone'] }}</td>
                                                    <td>{{ $employee['timestamp'] ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-muted">Klik total supervisor untuk melihat daftar karyawan.</p>
                                @endif

                                <div wire:loading wire:target="showEmployeeData">
                                    <div class="d-flex justify-content-center">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif

    @push('styles')
        <style>
            .modal {
                display: none;
            }

            .modal.show {
                display: block;
            }

            .modal-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1040;
                width: 100vw;
                height: 100vh;
                background-color: rgba(0, 0, 0, 0.5);
            }
        </style>
    @endpush
</div>
