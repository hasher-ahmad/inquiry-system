@extends('layouts.app')

@section('title', 'Inquiry Details')
@section('heading', 'Inquiry Details')

@section('content')

<div class="stat-card">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>Student Inquiry Details</h3>
            <p class="text-secondary mb-0">
                Complete information about this student.
            </p>
        </div>

        <a href="{{ route('inquiries.index') }}"
           class="btn btn-secondary">
            Back to Inquiries
        </a>
    </div>

    <hr>

    <div class="row g-4">

        <div class="col-md-6">
            <label class="text-secondary">Student Name</label>
            <h5>{{ $inquiry->name }}</h5>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Father Name</label>
            <h5>{{ $inquiry->father_name }}</h5>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Age</label>
            <h5>{{ $inquiry->age }}</h5>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">CNIC</label>
            <h5>{{ $inquiry->cnic }}</h5>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Phone Number</label>
            <h5>{{ $inquiry->phone }}</h5>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Email</label>
            <h5>{{ $inquiry->email }}</h5>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Qualification</label>
            <h5>{{ $inquiry->qualification }}</h5>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Course Name</label>
            <h5>{{ $inquiry->course_name }}</h5>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Source</label>
            <h5>{{ $inquiry->source }}</h5>
        </div>

        <div class="col-md-6">
            <label class="text-secondary">Date Added</label>
            <h5>
                {{ $inquiry->created_at->format('d M Y, h:i A') }}
            </h5>
        </div>

    </div>

    <hr>

    @if(auth()->id() == $inquiry->user_id)

        <div class="d-flex gap-2">

            <a href="{{ route('inquiries.edit', $inquiry->id) }}"
               class="btn btn-primary">
                Edit Inquiry
            </a>

            <form action="{{ route('inquiries.destroy', $inquiry->id) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this inquiry?')">

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    Delete Inquiry
                </button>

            </form>

        </div>

    @else

        <div class="alert alert-info mb-0">
            You can view this inquiry, but only its creator can edit or delete it.
        </div>

    @endif

</div>

@endsection