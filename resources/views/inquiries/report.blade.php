
@extends('layouts.app')

@section('title', 'Inquiry Report')
@section('heading', 'Student Inquiry Report')

@section('content')

<div class="section-heading">
    <div>
        <h3>Student Inquiry Report</h3>
        <p>
            {{ $fromDate->format('d M Y') }}
            to
            {{ $toDate->format('d M Y') }}
        </p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('reports.pdf', [
            'from_date' => request('from_date'),
            'to_date' => request('to_date')
        ]) }}" class="btn btn-primary">
            Download PDF
        </a>

        <button onclick="window.print()" class="btn btn-success">
            Print List
        </button>
    </div>
</div>

<div class="table-card mt-3">
    <div class="table-responsive">
        <table class="table custom-table align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Added Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($inquiries as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->father_name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->course_name }}</td>
                        <td>
                            {{ $item->created_at->format('d M Y, h:i A') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            No inquiries found for the selected dates.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3">
        <strong>Total Students: {{ $inquiries->count() }}</strong>
    </div>
</div>

@endsection
