<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceForm;

class ServiceFormController extends Controller
{
    public function submit(Request $request)
    {
        $data = $request->validate([
            'service_name' => 'required|string',
            'service_email' => 'required|email',
            'service_phone' => 'required|string',
            'service_requirement' => 'nullable|string',
            'service_check' => 'nullable|array',
        ]);

        $data['service_check'] = isset($data['service_check']) ? implode(', ', $data['service_check']) : null;

        ServiceForm::create($data);

        return back()->with('success', 'Your request has been submitted!');
    }
}
