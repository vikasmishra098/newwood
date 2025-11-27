<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceForm; // ✅ Corrected model

class ServiceRequestController extends Controller
{
    public function index()
    {
        $serviceForms = ServiceForm::latest()->paginate(10);
        return view('admin.service_requests.index', compact('serviceForms')); // ✅ Corrected view path
    }
}
