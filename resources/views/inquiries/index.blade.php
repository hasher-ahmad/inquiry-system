
@extends('layouts.app')

@section('title', 'All Inquiries')
@section('heading', 'All Inquiries')

@section('content')
<div class="section-heading">
    <div>
        <span class="eyebrow">RECORD MANAGEMENT</span>
        <h1>Student Inquiries</h1>
        <p>Search, filter, edit and manage student records.</p>
    </div>
    <a href="{{ route('inquiries.create') }}" class="btn-primary-custom">+ Add Query</a>
</div>

<form method="GET" action="{{ route('inquiries.index') }}" class="filter-card">
    <div class="row g-3 align-items-end">
        <div class="col-lg-6">
            <label>Search by name, email, CNIC or phone</label>
            <input class="form-control" name="search" value="{{ request('search') }}"
                   placeholder="Type a name or contact detail...">
        </div>
        <div class="col-lg-4">
            <label>Filter by course</label>
            <select class="form-select" name="course">
                <option value="">All Courses</option>
                @foreach($courses as $course)
                    <option value="{{ $course }}"
                        @selected(request('course') === $course)>
                        {{ $course }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 d-flex gap-2">
            <button class="btn-primary-custom flex-grow-1" type="submit">Search</button>
            <a class="btn-outline-custom" href="{{ route('inquiries.index') }}">Reset</a>
        </div>
    </div>
</form>

<div class="table-card mt-4">
    <div class="table-toolbar">
        <strong>Inquiry Records</strong>
        <span>{{ $inquiries->total() }} records found</span>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Father Name</th>
                    <th>Course</th>
                    <th>Phone</th>
                    <th>Reference</th>
                    <th>Added On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($inquiries as $item)
                <tr>
                   <td>
    <a href="{{ route('inquiries.show', $item->id) }}"
       class="text-decoration-none text-dark fw-bold">
        {{ $item->name }}
    </a>

    <small class="d-block text-secondary">
        {{ $item->email }}
    </small>

    <small class="d-block text-secondary">
        {{ $item->cnic }}
    </small>
</td>
                    <td>{{ $item->father_name }}</td>
                    <td><span class="course-badge">{{ $item->course_name }}</span></td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->source }}</td>
                    
<td>
    {{ $item->created_at->format('d M Y') }}
    <small class="d-block text-secondary">
        {{ $item->created_at->format('h:i A') }}
    </small>
</td>

<td>
    <div class="d-flex gap-2">
        @if(auth()->check() && (int) $item->user_id === (int) auth()->id())

            <a href="{{ route('inquiries.edit', $item->id) }}"
               class="action-edit">
                Edit
            </a>

            <form method="POST"
                  action="{{ route('inquiries.destroy', $item->id) }}"
                  onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
                @csrf
                @method('DELETE')

                <button type="submit" class="action-delete">
                    Delete
                </button>
            </form>

        @else
            <span class="text-secondary small">
                View only
            </span>
        @endif
    </div>
</td>

                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center py-5">
                    No matching inquiries found.
                </td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

   <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-4 mb-4">
    <div class="text-secondary small">
        Showing {{ $inquiries->firstItem() ?? 0 }}
        to {{ $inquiries->lastItem() ?? 0 }}
        of {{ $inquiries->total() }} inquiries
    </div>

    <div>
        {{ $inquiries->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>
</div>
@endsection
