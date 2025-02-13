<div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Delayed Activities</h4>
            <p class="text-muted">Menampilkan jumlah aktivitas yang terlambat, sedang dikerjakan, dan tepat waktu.</p>

            <div id="delayed_activities"
                data-colors='["--bs-success","--bs-danger", "--bs-warning","--bs-info", "--bs-primary"]'
                class="apex-charts mt-4" dir="ltr"></div>

            <div class="d-flex justify-content-between text-center">
                <div class="flex-grow-1">
                    <p class="mb-2 text-truncate">
                        <i id="icon-on_time" class="mdi mdi-circle me-1"></i> Solved
                    </p>
                    <h4 class="mb-0" id="on_time-count">0</h4>
                </div>
                <div class="flex-grow-1">
                    <p class="mb-2 text-truncate">
                        <i id="icon-late" class="mdi mdi-circle me-1"></i> Unsolved
                    </p>
                    <h4 class="mb-0" id="late-count">0</h4>
                </div>
                <div class="flex-grow-1">
                    <p class="mb-2 text-truncate">
                        <i id="icon-progress" class="mdi mdi-circle me-1"></i> Unsolved
                    </p>
                    <h4 class="mb-0" id="progress-count">0</h4>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('livewire:init', function() {
                var pieChartColors = getChartColorsArray("delayed_activities");

                var on_time = {{ $on_time }};
                var late = {{ $late }};
                var in_progress = {{ $in_progress }};

                if (pieChartColors) {
                    var options = {
                        chart: {
                            height: 320,
                            type: "donut"
                        },
                        labels: ['On Time', 'Late', 'In Progress'],
                        series: [on_time, late, in_progress],
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

                    var chart = new ApexCharts(document.querySelector("#delayed_activities"), options);
                    chart.render();


                    // 🔹 Update Counter
                    document.getElementById("on_time-count").textContent = on_time;
                    document.getElementById("late-count").textContent = late;
                    document.getElementById("progress-count").textContent = in_progress;

                    // 🔹 Update Icon Colors
                    document.getElementById("icon-on_time").style.color = pieChartColors[0];
                    document.getElementById("icon-late").style.color = pieChartColors[1];
                    document.getElementById("icon-progress").style.color = pieChartColors[2];
                }
            })
        </script>
    @endpush
</div>
