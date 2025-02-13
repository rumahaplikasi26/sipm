<div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Delayed Activities</h4>
            <p class="text-muted">Menampilkan jumlah aktivitas yang terlambat, sedang dikerjakan, dan tepat waktu.</p>

            <div id="delayed_activities"
                data-colors='["--bs-success","--bs-danger", "--bs-warning","--bs-info", "--bs-primary"]'
                class="apex-charts mt-4" dir="ltr"></div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('livewire:init', function() {
                var pieChartColors = getChartColorsArray("delayed_activities");
                if (pieChartColors) {
                    var options = {
                        chart: {
                            height: 320,
                            type: "donut"
                        },
                        labels: ['On Time', 'Late', 'In Progress'],
                        series: [{{ $on_time }}, {{ $late }}, {{ $in_progress }}],
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

                    var chart = new ApexCharts(document.querySelector("#delayed_activities"), options);
                    chart.render();
                }
            })
        </script>
    @endpush
</div>
