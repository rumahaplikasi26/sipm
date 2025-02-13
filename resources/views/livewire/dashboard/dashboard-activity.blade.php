<div>
    @livewire('component.layout.breadcrumb', ['breadcrumbs' => [['name' => 'Dashboard Activity']]], key('breadcrumb-component'))

    @can('dashboard.index')
        <div class="row">
            <div class="col-md-4">
                @livewire('dashboard.dashboard-activity.activity-by-status', ['date' => $date], key('dashboard-activity-by-status'))
            </div>
            <div class="col-md-4">
                @livewire('dashboard.dashboard-activity.activity-by-area', ['date' => $date], key('dashboard-activity-by-area'))
            </div>
            <div class="col-md-4">
                @livewire('dashboard.dashboard-activity.activity-issue-by-area', ['date' => $date], key('dashboard-activity-issue-by-area'))
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                @livewire('dashboard.dashboard-activity.delayed-activity', ['date' => $date], key('dashboard-delayed-activity'))
            </div>
            <div class="col-md-6">
                @livewire('dashboard.dashboard-activity.activity-issue-resolved', ['date' => $date], key('dashboard-activity-issue-resolved'))
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                @livewire('dashboard.dashboard-activity.activity-progress', ['date' => $date], key('dashboard-activity-progress'))
            </div>
            <div class="col-md-6">

            </div>
        </div>
    @endcan

    @push('js')
        <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>

        <script>
            function getChartColorsArray(e) {
                if (null !== document.getElementById(e)) {
                    var t = document.getElementById(e).getAttribute("data-colors");
                    if (t)
                        return (t = JSON.parse(t)).map(function(e) {
                            var t = e.replace(" ", "");
                            if (-1 === t.indexOf(",")) {
                                var r = getComputedStyle(document.documentElement).getPropertyValue(
                                    t
                                );
                                return r || t;
                            }
                            var o = e.split(",");
                            return 2 != o.length ?
                                t :
                                "rgba(" +
                                getComputedStyle(document.documentElement).getPropertyValue(
                                    o[0]
                                ) +
                                "," +
                                o[1] +
                                ")";
                        });
                    console.warn("data-colors Attribute not found on:", e);
                }
            }
        </script>
    @endpush
</div>
