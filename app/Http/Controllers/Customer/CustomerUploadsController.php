<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerReport;
use App\Models\CustomerFeedback;

class CustomerUploadsController extends Controller
{
    public function saveReport(Request $request)
    {
        $request->validate([
            'report_file' => 'required|file',
        ]);

        $fileName = time().'-'.$request->report_file->getClientOriginalName();
        $request->report_file->move(public_path('uploads/reports'), $fileName);

        CustomerReport::create([
            'file' => $fileName,
        ]);

        return back()->with('success','Report Uploaded');
    }

    public function saveFeedback(Request $request)
    {
        $request->validate([
            'feedback_file' => 'required|file',
        ]);

        $fileName = time().'-'.$request->feedback_file->getClientOriginalName();
        $request->feedback_file->move(public_path('uploads/feedbacks'), $fileName);

        CustomerFeedback::create([
            'file' => $fileName,
        ]);

        return back()->with('success','Feedback Uploaded');
    }

    public function index()
    {
        $reports = CustomerReport::latest()->get();
        $feedbacks = CustomerFeedback::latest()->get();

        return view('customer.uploads.index', compact('reports','feedbacks'));
    }
}
