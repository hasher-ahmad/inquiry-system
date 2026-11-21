
@extends('layouts.app')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
<div class="welcome-banner">
    <div>
        <span class="eyebrow">ELC INSTITUTE · ADMIN PANEL</span>
        <h1>Welcome back, {{ auth()->user()->name }}!</h1>
        <p>Manage student inquiries from one place.</p>
        <a href="{{ route('inquiries.create') }}" class="btn-light-custom">
            + Add New Inquiry
        </a>
    </div>
    <div class="banner-symbol">✦</div>
</div>

<div class="stat-card mt-3">
    <h4>Student Inquiry Report</h4>
    <p>Select a date range to view and download student inquiries.</p>

    <form action="{{ route('reports.index') }}" method="GET">
        <div class="row g-3 align-items-end">

            <div class="col-md-4">
                <label for="from_date" class="form-label">
                    From Date
                </label>
                <input
                    type="date"
                    name="from_date"
                    id="from_date"
                    class="form-control"
                    value="{{ date('Y-m-01') }}"
                    required
                >
            </div>

            <div class="col-md-4">
                <label for="to_date" class="form-label">
                    To Date
                </label>
                <input
                    type="date"
                    name="to_date"
                    id="to_date"
                    class="form-control"
                    value="{{ date('Y-m-d') }}"
                    required
                >
            </div>

            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">
                    View Student List
                </button>
            </div>

        </div>
    </form>
</div>

<div class="row g-3 mt-2">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon purple">☷</div>
            <p>Total Inquiries</p>
            <h2>{{ $totalInquiries }}</h2>
            <span>All registered student inquiries</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon green">◷</div>
            <p>Today's Inquiries</p>
            <h2>{{ $todayInquiries }}</h2>
            <span>Added today</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon orange">▤</div>
            <p>Courses</p>
            <h2>{{ $courseCount }}</h2>
            <span>Distinct courses in records</span>
        </div>
    </div>
</div>

<div class="section-heading mt-4">
    <div>
        <h3>Recent Inquiries</h3>
        <p>Latest student records added to the system</p>
    </div>
    <a href="{{ route('inquiries.index') }}" class="text-link">View all →</a>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table class="table custom-table align-middle">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Contact</th>
                    <th>Date & Time Added</th>
                </tr>
            </thead>
         <tbody>
    @forelse($recentInquiries as $item)
        <tr>
            <td>
                <a href="{{ route('inquiries.show', $item->id) }}"
                   class="text-decoration-none text-dark fw-bold">
                    {{ $item->name }}
                </a>

                <small class="d-block text-secondary">
                    {{ $item->email }}
                </small>
            </td>

            <td>
                <a href="{{ route('inquiries.show', $item->id) }}"
                   class="text-decoration-none">
                    <span class="course-badge">
                        {{ $item->course_name }}
                    </span>
                </a>
            </td>

            <td>
                <a href="{{ route('inquiries.show', $item->id) }}"
                   class="text-decoration-none text-dark">
                    {{ $item->phone }}
                </a>
            </td>

            <td>
                <a href="{{ route('inquiries.show', $item->id) }}"
                   class="text-decoration-none text-dark">
                    {{ $item->created_at->format('d M Y, h:i A') }}
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center py-5">
                No inquiries yet. Add your first inquiry to get started.
            </td>
        </tr>
    @endforelse
</tbody>
        </table>
    </div>
</div>
@endsection
