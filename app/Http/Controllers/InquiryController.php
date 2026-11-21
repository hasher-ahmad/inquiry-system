<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('cnic', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('course')) {
            $query->where('course_name', $request->course);
        }

        $inquiries = $query->latest()->paginate(10)->withQueryString();

        $courses = Inquiry::select('course_name')
            ->distinct()
            ->orderBy('course_name')
            ->pluck('course_name');

        return view('inquiries.index', compact('inquiries', 'courses'));
    }

    public function create()
    {
        return view('inquiries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'father_name' => ['required', 'string', 'max:255'],
            'age' => ['integer', 'min:1', 'max:120'],
            'cnic' => [
                
                'regex:/^\d{5}-\d{7}-\d{1}$/',
                'unique:inquiries,cnic',
            ],
            'phone' => ['required', 'string', 'max:20'],
            'qualification' => ['string', 'max:255'],
            'course_name' => ['string', 'max:255'],
            'source' => [
                'required',
                
                Rule::in([
                    'Flex',
                    'Facebook',
                    'Instagram',
                    'Social Media',
                    'Website',
                    'Friend',
                    'Walk-in',
                    'Other',
                ]),
            ],
            'email' => ['required', 'email', 'max:255'],
        ]);

      Inquiry::create([
    ...$validated,
    'user_id' => auth()->id(),
]);

        return redirect()->route('inquiries.index')
            ->with('success', 'Inquiry added successfully.');
    }

   public function edit(Inquiry $inquiry)
{
    abort_unless(
        (int) $inquiry->user_id === (int) auth()->id(),
        403,
        'You are not allowed to edit this inquiry.'
    );

    return view('inquiries.edit', compact('inquiry'));
}

   public function update(Request $request, Inquiry $inquiry)
{
    // Sirf inquiry add karne wala user usay update kar sakta hai
    abort_unless(
        (int) $inquiry->user_id === (int) auth()->id(),
        403,
        'You are not allowed to update this inquiry.'
    );

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'father_name' => ['string', 'max:255'],
        'age' => ['integer', 'min:1', 'max:120'],

        'cnic' => [
            'required',
            'regex:/^\d{5}-\d{7}-\d{1}$/',
            Rule::unique('inquiries', 'cnic')->ignore($inquiry->id),
        ],

        'phone' => ['required', 'string', 'max:20'],
        'qualification' => ['string', 'max:255'],
        'course_name' => ['required', 'string', 'max:255'],

        'source' => [
            'required',
            Rule::in([
                'Flex',
                'Facebook',
                'Instagram',
                'Social Media',
                'Website',
                'Friend',
                'Walk-in',
                'Other',
            ]),
        ],

        'email' => ['required', 'email', 'max:255'],
    ]);

    $inquiry->update($validated);

    return redirect()
        ->route('inquiries.index')
        ->with('success', 'Inquiry updated successfully.');
}
   
public function destroy(Inquiry $inquiry)
{
    abort_unless(
        (int) $inquiry->user_id === (int) auth()->id(),
        403,
        'You are not allowed to delete this inquiry.'
    );

    $inquiry->delete();

    return redirect()
        ->route('inquiries.index')
        ->with('success', 'Inquiry deleted successfully.');
}
public function show(Inquiry $inquiry)
{
    return view('inquiries.show', compact('inquiry'));
}
}

