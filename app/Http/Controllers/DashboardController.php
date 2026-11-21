<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalInquiries' => Inquiry::count(),

            'todayInquiries' => Inquiry::whereDate(
                'created_at',
                today()
            )->count(),

            'courseCount' => Inquiry::distinct('course_name')
                ->count('course_name'),

            'recentInquiries' => Inquiry::latest()
                ->take(5)
                ->get(),
        ]);
    }
}