<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        Contact::create($request->only('first_name', 'last_name', 'company', 'email', 'phone', 'message'));

        return redirect()->back()->with('success', 'Your message has been submitted.');
    }

    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }
}
