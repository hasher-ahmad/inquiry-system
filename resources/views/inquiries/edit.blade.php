
@extends('layouts.app')

@section('title', 'Update Inquiry')
@section('heading', 'Update Inquiry')

@section('content')
<div class="form-heading">
    <span class="eyebrow">RECORD MANAGEMENT</span>
    <h1>Update Student Inquiry</h1>
    <p>Edit the details and save your changes.</p>
</div>

<form method="POST" action="{{ route('inquiries.update', $inquiry) }}" class="form-card">
    @csrf
    @method('PUT')

    <h5 class="form-section-title">01 — Personal Information</h5>
    <div class="row g-3">
        <div class="col-md-6">
            <label>Student Name *</label>
            <input class="form-control" name="name"
                   value="{{ old('name', $inquiry->name) }}" required>
        </div>
        <div class="col-md-6">
            <label>Father Name *</label>
            <input class="form-control" name="father_name"
                   value="{{ old('father_name', $inquiry->father_name) }}" required>
        </div>
        <div class="col-md-4">
            <label>Age *</label>
            <input class="form-control" type="number" name="age" min="1" max="120"
                   value="{{ old('age', $inquiry->age) }}" required>
        </div>
        <div class="col-md-4">
            <label>CNIC *</label>
            <input class="form-control" name="cnic"
                   pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}"
                   value="{{ old('cnic', $inquiry->cnic) }}" required>
        </div>
        <div class="col-md-4">
            <label>Phone *</label>
            <input class="form-control" name="phone"
                   value="{{ old('phone', $inquiry->phone) }}" required>
        </div>
        <div class="col-md-6">
            <label>Email *</label>
            <input class="form-control" type="email" name="email"
                   value="{{ old('email', $inquiry->email) }}" required>
        </div>
        <div class="col-md-6">
            <label>Qualification *</label>
            <input class="form-control" name="qualification"
                   value="{{ old('qualification', $inquiry->qualification) }}" required>
        </div>
    </div>

    <hr class="my-4">
    <h5 class="form-section-title">02 — Course & Reference</h5>

    <div class="row g-3">
        <div class="col-md-6">
            <label>Course Name *</label>
            <input class="form-control" name="course_name"
                   value="{{ old('course_name', $inquiry->course_name) }}" required>
        </div>
        <div class="col-md-6">
            <label>Reference Source *</label>
            <select class="form-select" name="source" required>
                @foreach(['Flex','Facebook','Instagram','Social Media','Website','Friend','Walk-in','Other'] as $source)
                    <option value="{{ $source }}"
                        @selected(old('source', $inquiry->source) === $source)>
                        {{ $source }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-actions mt-4">
        <a href="{{ route('inquiries.index') }}" class="btn-outline-custom">Cancel</a>
        <button type="submit" class="btn-primary-custom">Save Changes →</button>
    </div>
</form>
@endsection
