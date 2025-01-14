<!-- resources/views/exports/activity-report.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Report Activities</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #f3f4f6;
            padding: 6px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            border: 1px solid #ddd;
        }
        td {
            padding: 6px;
            border: 1px solid #ddd;
            font-size: 8px;
            vertical-align: top;
        }
        .report-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .timestamp {
            text-align: right;
            font-size: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="report-title">Report Activities</div>

    <div class="timestamp">
        Generated: {{ $generated_at }}
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Title</th>
                <th>Group</th>
                <th>Position</th>
                <th>Scope</th>
                <th>Est. Time</th>
                <th>Forecast</th>
                <th>Plan</th>
                <th>Actual</th>
                <th>Progress</th>
                <th>Supervisor</th>
                <th>Dependencies</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity['id'] }}</td>
                    <td>{{ $activity['date'] }}</td>
                    <td>{{ $activity['title'] }}</td>
                    <td>{{ $activity['group']['name'] ?? '-' }}</td>
                    <td>{{ $activity['position']['name'] ?? '-' }}</td>
                    <td>{{ $activity['scope']['name'] ?? '-' }}</td>
                    <td>{{ $activity['total_estimate'] }} {{ $activity['type_estimate'] }}</td>
                    <td>{{ $activity['forecast_date'] }}</td>
                    <td>{{ $activity['plan_date'] }}</td>
                    <td>{{ $activity['actual_date'] }}</td>
                    <td>{{ $activity['progress'] }}%</td>
                    <td>{{ $activity['supervisor']['name'] ?? '-' }}</td>
                    <td>
                        @if(!empty($activity['issues']))
                            @foreach($activity['issues'] as $issue)
                                {{ $issue['category_dependency']['name'] ?? '-' }}@if(!$loop->last),@endif
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
