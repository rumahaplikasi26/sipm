<div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Activity Issue By Area</h4>
            <p class="text-muted">Menampilkan jumlah issue per area</p>

            <div id="dependency_by_area_chart"
                data-colors='["--bs-success","--bs-danger", "--bs-warning","--bs-info", "--bs-primary"]'
                class="apex-charts mt-4" dir="ltr"></div>

            <div id="dependency_by_area_chart_list" class="d-flex flex-wrap justify-content-between">
            </div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('livewire:init', function() {
                var pieChartColors = getChartColorsArray("dependency_by_area_chart");
                var labels = @json($averageDependencyByArea->keys());
                var series = @json($averageDependencyByArea->values());

                if (pieChartColors) {
                    var options = {
                        chart: {
                            height: 320,
                            type: "donut"
                        },
                        series: series,
                        labels: labels,
                        colors: pieChartColors,
                        legend: {
                            show: true,
                            position: "top",
                            horizontalAlign: "center",
                            verticalAlign: "middle",
                            floating: false,
                            fontSize: "14px",
                            offsetX: 0,
                        },
                        yaxis: {
                            labels: {
                                formatter: function(value) {
                                    return value + " ISSUES";
                                }
                            }
                        }
                    };
                    var chart = new ApexCharts(document.querySelector("#dependency_by_area_chart"), options);
                    chart.render();

                    // 🔹 Generate Dynamic List Below Chart
                    var listContainer = document.getElementById("dependency_by_area_chart_list");
                    listContainer.innerHTML = "";
                    labels.forEach((label, index) => {
                        var color = pieChartColors[index % pieChartColors.length];
                        listContainer.innerHTML += `
                                <div class="flex-grow-1 text-center">
                                    <p class="mb-2 text-truncate">
                                        <i class="mdi mdi-circle me-2" style="color: ${color};"></i> ${label}
                                    </p>
                                    <h4 class="mb-0" id="solved-count">${series[index]}</h4>
                                </div>
                        `;
                    });
                }
            })
        </script>
    @endpush
</div>
