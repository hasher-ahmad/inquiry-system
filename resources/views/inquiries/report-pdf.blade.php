<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Student Inquiry Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 8px;
        }

        .report-date {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #555;
            padding: 9px;
            text-align: left;
        }

        th {
            background-color: #e9ecef;
        }
    </style>
</head>

<body>

    <h2>Student Inquiry Report</h2>

    <div class="report-date">
        From: {{ $fromDate }}
        &nbsp;&nbsp;&nbsp;
        To: {{ $toDate }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Father Name</th>
                <th>Phone Number</th>
                <th>Course Name</th>
            </tr>
        </thead>

        <tbody>
            @forelse($inquiries as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->father_name }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->course_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">
                        No inquiries found for the selected dates.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>