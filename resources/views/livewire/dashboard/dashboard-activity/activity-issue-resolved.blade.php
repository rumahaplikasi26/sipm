<div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Activity Issue Resolved</h4>
            <p class="text-muted">Menampilkan jumlah issue yang sudah dan belum selesai.</p>

            <div id="activity_issue_resolved"
                data-colors='["--bs-success","--bs-danger", "--bs-warning","--bs-info", "--bs-primary"]'
                class="apex-charts mt-4" dir="ltr"></div>

            <!-- Dynamic Counter -->
            <div class="d-flex justify-content-between text-center">
                <div class="flex-grow-1">
                    <p class="mb-2 text-truncate">
                        <i id="icon-solved" class="mdi mdi-circle me-1"></i> Solved
                    </p>
                    <h4 class="mb-0" id="solved-count">0</h4>
                </div>
                <div class="flex-grow-1">
                    <p class="mb-2 text-truncate">
                        <i id="icon-unsolved" class="mdi mdi-circle me-1"></i> Unsolved
                    </p>
                    <h4 class="mb-0" id="unsolved-count">0</h4>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('livewire:init', function() {
                var pieChartColors = getChartColorsArray("activity_issue_resolved");

                var solved = {{ $solved }};
                var unsolved = {{ $unsolved }};

                if (pieChartColors) {
                    var options = {
                        chart: {
                            height: 320,
                            type: "donut"
                        },
                        labels: ['Solved', 'Unsolved'],
                        series: [solved, unsolved],
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

                    var chart = new ApexCharts(document.querySelector("#activity_issue_resolved"), options);
                    chart.render();

                    // 🔹 Update Counter
                    document.getElementById("solved-count").textContent = solved;
                    document.getElementById("unsolved-count").textContent = unsolved;

                    // 🔹 Update Icon Colors
                    document.getElementById("icon-solved").style.color = pieChartColors[0];
                    document.getElementById("icon-unsolved").style.color = pieChartColors[1];
                }
            })
        </script>
    @endpush
</div>
