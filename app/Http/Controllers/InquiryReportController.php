<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InquiryReportController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'from_date' => ['required', 'date'],
            'to_date' => [
                'required',
                'date',
                'after_or_equal:from_date',
            ],
        ]);

        $fromDate = Carbon::parse($request->from_date)->startOfDay();
        $toDate = Carbon::parse($request->to_date)->endOfDay();

        $inquiries = Inquiry::whereBetween('created_at', [
            $fromDate,
            $toDate,
        ])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('inquiries.report', compact(
            'inquiries',
            'fromDate',
            'toDate'
        ));
    }

    public function pdf(Request $request)
    {
        $request->validate([
            'from_date' => ['required', 'date'],
            'to_date' => [
                'required',
                'date',
                'after_or_equal:from_date',
            ],
        ]);

        $fromDate = Carbon::parse($request->from_date)->startOfDay();
        $toDate = Carbon::parse($request->to_date)->endOfDay();

        $inquiries = Inquiry::whereBetween('created_at', [
            $fromDate,
            $toDate,
        ])
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView(
            'inquiries.report-pdf',
            compact('inquiries', 'fromDate', 'toDate')
        )->setPaper('a4', 'landscape');

        return $pdf->download('student-inquiries-report.pdf');
    }
}