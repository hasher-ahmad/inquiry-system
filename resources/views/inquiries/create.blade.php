
@extends('layouts.app')

@section('title', 'Add Query')
@section('heading', 'Add New Query')

@section('content')
<div class="form-heading">
    <span class="eyebrow">STUDENT ADMISSIONS</span>
    <h1>New Student Inquiry</h1>
    <p>Enter the student's details below. Fields marked * are required.</p>
</div>

<form method="POST" action="{{ route('inquiries.store') }}" class="form-card">
    @csrf

    <h5 class="form-section-title">01 — Personal Information</h5>
    <div class="row g-3">
        <div class="col-md-6">
            <label>Student Name *</label>
            <input class="form-control" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="col-md-6">
            <label>Father Name *</label>
            <input class="form-control" name="father_name"
                   value="{{ old('father_name') }}" required>
        </div>
        <div class="col-md-4">
            <label>Age *</label>
            <input class="form-control" type="number" name="age"
                   min="1" max="120" value="{{ old('age') }}" required>
        </div>
        <div class="col-md-4">
            <label>CNIC * (XXXXX-XXXXXXX-X)</label>
            <input class="form-control" name="cnic"
                   placeholder="12345-1234567-1" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}"
                   value="{{ old('cnic') }}" required>
        </div>
        <div class="col-md-4">
            <label>Phone Number *</label>
            <input class="form-control" name="phone"
                   placeholder="03XX-XXXXXXX" value="{{ old('phone') }}" required>
        </div>
        <div class="col-md-6">
            <label>Email Address *</label>
            <input class="form-control" type="email" name="email"
                   value="{{ old('email') }}" required>
        </div>
        <div class="col-md-6">
            <label>Qualification *</label>
            <input class="form-control" name="qualification"
                   placeholder="Matric, Intermediate, BS..." value="{{ old('qualification') }}" required>
        </div>
    </div>

    <hr class="my-4">
    <h5 class="form-section-title">02 — Course & Reference</h5>

    <div class="row g-3">
        <div class="col-md-6">
            <label>Course Name *</label>
            <input class="form-control" name="course_name"
                   placeholder="e.g. Web Development" value="{{ old('course_name') }}" required>
        </div>
        <div class="col-md-6">
            <label>How did you hear about ELC? *</label>
            <select class="form-select" name="source" required>
                <option value="">Select source</option>
                @foreach(['Flex','Facebook','Instagram','Social Media','Website','Friend','Walk-in','Other'] as $source)
                    <option value="{{ $source }}" @selected(old('source') === $source)>
                        {{ $source }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-actions mt-4">
        <a href="{{ route('inquiries.index') }}" class="btn-outline-custom">Cancel</a>
        <button class="btn-primary-custom" type="submit">Save Inquiry →</button>
    </div>
</form>
@endsection
