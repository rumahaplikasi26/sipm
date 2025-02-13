<div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Activities By Area</h4>
            <p class="text-muted">Menampilkan jumlah aktivitas per area</p>
            <div id="activity_by_area"
                data-colors='["--bs-success","--bs-danger", "--bs-warning","--bs-info", "--bs-primary", "--bs-secondary"]'
                class="apex-charts mt-4" dir="ltr"></div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('livewire:init', function() {
                var pieChartColors = getChartColorsArray("activity_by_area");
                if (pieChartColors) {
                    var options = {
                        chart: {
                            height: 320,
                            type: "pie"
                        },
                        series: @json($activitiesByArea->values()),
                        labels: @json($activitiesByArea->keys()),
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
                                    return value+ " ACTIVITIES";
                                }
                            }
                        }
                    };
                    var chart = new ApexCharts(document.querySelector("#activity_by_area"), options);
                    chart.render();
                }
            })
        </script>
    @endpush
</div>
