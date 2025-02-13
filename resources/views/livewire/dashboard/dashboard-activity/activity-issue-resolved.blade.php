<div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Activity Issue Resolved</h4>
            <p class="text-muted">Menampilkan jumlah issue yang sudah dan belum ada solusi.</p>

            <div id="activity_issue_resolved"
                data-colors='["--bs-success","--bs-danger", "--bs-warning","--bs-info", "--bs-primary"]'
                class="apex-charts mt-4" dir="ltr"></div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('livewire:init', function() {
                var pieChartColors = getChartColorsArray("activity_issue_resolved");
                if (pieChartColors) {
                    var options = {
                        chart: {
                            height: 320,
                            type: "donut"
                        },
                        labels: ['Solved', 'Unsolved'],
                        series: [{{ $solved }}, {{ $unsolved }}],
                        colors: pieChartColors,
                        legend: {
                            show: true,
                            position: "bottom",
                            horizontalAlign: "center",
                            verticalAlign: "middle",
                            floating: false,
                            fontSize: "14px",
                            offsetX: 0,
                        },
                        yaxis: {
                            labels: {
                                formatter: function(value) {
                                    return value+ " ISSUES";
                                }
                            }
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#activity_issue_resolved"), options);
                    chart.render();
                }
            })
        </script>
    @endpush
</div>
