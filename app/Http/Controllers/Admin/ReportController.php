<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;

class ReportController extends Controller
{
    /**
     * Display all employee reports.
     */
    public function index()
    {
        // Fetch all employees (latest first)
        $employees = Employee::orderBy('id', 'desc')->get();

        // Return view with data
        return view('admin.allreport.report', compact('employees'));
    }
}
