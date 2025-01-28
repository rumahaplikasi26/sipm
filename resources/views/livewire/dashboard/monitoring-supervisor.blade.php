<div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">Monitoring Present By Supervisor Date {{ $dateString }}</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle table-sm">
                        <thead>
                            <tr class="text-center align-middle">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Group</th>
                                <th rowspan="2">Supervisor</th>
                                @foreach ($timeTypes as $type)
                                    <th scope="col" colspan="4">{{ str_pad($type, 2, '0', STR_PAD_LEFT) . ':00' }}</th>
                                @endforeach
                            </tr>
                            <tr class="text-center align-middle">
                                @foreach ($timeTypes as $type)
                                    <th class="text-center">H</th>
                                    <th class="text-center">S</th>
                                    <th class="text-center">TK</th>
                                    <th class="text-center">PS</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($monitoringData as $group)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="">{{ $group['group_name'] }}</td>
                                    <td class="">{{ $group['supervisor_name'] }}</td>
                                    @foreach ($group['types'] as $time => $typeData)
                                        <td class="text-center">{{ $typeData['H'] }}</td>
                                        <td class="text-center">{{ $typeData['S'] }}</td>
                                        <td class="text-center">{{ $typeData['TK'] }}</td>
                                        <td class="text-center">{{ $typeData['PS'] }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <p class="text-muted font-size-10">Keterangan : <br>
                        H = Hadir <br>
                        S = Sakit <br>
                        TK = Tanpa Keterangan <br>
                        PS = Pindah Supervisor <br>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
