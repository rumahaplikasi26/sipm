<div>
    <div id="{{ $chart_id }}" data-colors='["--bs-primary"]' class="apex-charts"></div>

    @push('js')
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>

        <script>
            document.addEventListener("livewire:init", function(e) {

                var chart;

                function renderChart() {
                    var options;
                    options = {
                        chart: {
                            height: {{ $height }},
                            type: "radialBar",
                            offsetY: -10
                        },
                        plotOptions: {
                            radialBar: {
                                startAngle: -135,
                                endAngle: 135,
                                dataLabels: {
                                    name: {
                                        fontSize: "13px",
                                        color: void 0,
                                        offsetY: 60
                                    },
                                    value: {
                                        offsetY: 22,
                                        fontSize: "16px",
                                        color: void 0,
                                        formatter: function(e) {
                                            return e + "%";
                                        },
                                    },
                                },
                            },
                        },
                        colors: ['rgba(255, 99, 71, 1)'],
                        fill: {
                            type: "gradient",
                            gradient: {
                                shade: "dark",
                                shadeIntensity: 0.15,
                                inverseColors: !1,
                                opacityFrom: 1,
                                opacityTo: 1,
                                stops: [0, 50, 65, 91],
                            },
                        },
                        stroke: {
                            dashArray: 4
                        },
                        series: {!! json_encode($series) !!},
                        labels: {!! json_encode($labels) !!},
                    }

                    chart = new ApexCharts(
                        document.querySelector("#{{ $chart_id }}"),
                        options
                    ).render();
                }

                renderChart();
            })
        </script>
    @endpush
</div>
