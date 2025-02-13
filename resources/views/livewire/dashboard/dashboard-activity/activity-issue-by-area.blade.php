<div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Activity Issue By Area</h4>
            <p class="text-muted">Menampilkan jumlah issue per area</p>

            <div id="dependency_by_area_chart"
                data-colors='["--bs-success","--bs-danger", "--bs-warning","--bs-info", "--bs-primary"]'
                class="apex-charts mt-4" dir="ltr"></div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('livewire:init', function() {
                var pieChartColors = getChartColorsArray("dependency_by_area_chart");
                if (pieChartColors) {
                    var options = {
                        chart: {
                            height: 320,
                            type: "donut"
                        },
                        series: @json($averageDependencyByArea->values()),
                        labels: @json($averageDependencyByArea->keys()),
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
                    var chart = new ApexCharts(document.querySelector("#dependency_by_area_chart"), options);
                    chart.render();
                }
            })
        </script>
    @endpush
</div>
