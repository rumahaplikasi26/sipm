<div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Activities By Status</h4>
            <p class="text-muted">Menampilkan jumlah aktivitas per status</p>

            <div id="activity_by_status"
                data-colors='["--bs-success","--bs-danger", "--bs-warning","--bs-info", "--bs-primary"]'
                class="apex-charts mt-4" dir="ltr"></div>

            <div id="activity_by_status_list" class="d-flex flex-wrap justify-content-between">
            </div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('livewire:init', function() {
                var pieChartColors = getChartColorsArray("activity_by_status");

                var labels = @json($activitiesByStatus->keys());
                var series = @json($activitiesByStatus->values());

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
                                    return value + " ACTIVITIES";
                                }
                            }
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#activity_by_status"), options);
                    chart.render();

                    // 🔹 Generate Dynamic List Below Chart
                    var listContainer = document.getElementById("activity_by_status_list");
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
