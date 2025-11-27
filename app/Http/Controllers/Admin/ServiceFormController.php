<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceForm;

class ServiceFormController extends Controller
{
    public function index()
    {
        $serviceForms = ServiceForm::latest()->paginate(10);
        return view('admin.service_forms.index', compact('serviceForms'));
    }
}
