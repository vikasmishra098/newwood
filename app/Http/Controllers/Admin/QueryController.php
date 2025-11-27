<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Queries;
use Illuminate\Http\Request;
use Carbon\Carbon;


class QueryController extends Controller
{

    public function index()
    {
        $queries = Queries::all()->sortBy(function($q){

            // 1) closed bottom
            $statusOrder = ($q->qstatus == 'Closed') ? 1 : 0;

            // 2) near date top
            $dateDiff = Carbon::now()->diffInDays(Carbon::parse($q->qtarget_date), false);

            return sprintf('%d-%05d', $statusOrder, $dateDiff);
        })->values();

        return view('admin.queries.index', compact('queries'));
    }

    public function create()
    {
        return view('admin.queries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'qname' => 'required|string|max:255',
            'qemail' => 'required|email',
            'qphone' => 'required|string|max:20',
            'qcar' => 'nullable|string|max:255',
            'qcomment' => 'nullable|string',
            'qfollow' => 'nullable|string|max:255',
            'qpriority' => 'required|in:Low,Medium,High',
            'qstatus' => 'required|in:Open,In Progress,Closed',
            'qtimeline' => 'nullable|array',
            'qtarget_date' => 'nullable|date',
            'notify_to' => 'required|in:admin,subadmin',
        ]);

        $validated['qtimeline'] = json_encode($validated['qtimeline'] ?? []);

        Queries::create($validated);

        $number = $validated['notify_to']=='admin' ? '9266666624' : '9312328996';
$number = preg_replace('/[^0-9]/', '', $number); // clean number

$message = "New Query Added
Name: {$validated['qname']}
Email: {$validated['qemail']}
Phone: {$validated['qphone']}
Address: {$validated['qcar']}
Comment: {$validated['qcomment']}
Target Date: {$validated['qtarget_date']}";

return redirect("https://wa.me/91{$number}?text=" . urlencode($message));


        return redirect()->route('admin.queries.index')->with('success', 'Query created successfully.');
    }

    public function edit($id)
    {
        $query = Queries::findOrFail($id);
        return view('admin.queries.edit', compact('query'));
    }

    public function update(Request $request, $id)
    {
        $query = Queries::findOrFail($id);

        $validated = $request->validate([
            'qname' => 'required|string|max:255',
            'qemail' => 'required|email',
            'qphone' => 'required|string|max:20',
            'qcar' => 'nullable|string|max:255',
            'qcomment' => 'nullable|string',
            'qfollow' => 'nullable|string|max:255',
            'qpriority' => 'required|in:Low,Medium,High',
            'qstatus' => 'required|in:Open,In Progress,Closed',
            'qtimeline' => 'nullable|array',
            'qtarget_date' => 'nullable|date',
            'notify_to' => 'required|in:admin,subadmin',
        ]);

        $validated['qtimeline'] = json_encode($validated['qtimeline'] ?? []);

        $query->update($validated);

        $number = $validated['notify_to']=='admin' ? '9266666624' : '9312328996';
$number = preg_replace('/[^0-9]/', '', $number); // clean number

$message = "New Query Added
Name: {$validated['qname']}
Email: {$validated['qemail']}
Phone: {$validated['qphone']}
Address: {$validated['qcar']}
Comment: {$validated['qcomment']}
Target Date: {$validated['qtarget_date']}";

return redirect("https://wa.me/91{$number}?text=" . urlencode($message));


        return redirect()->route('admin.queries.index')->with('success', 'Query updated successfully.');
    }

    
 public function show($id)
{
    $query = Queries::with('followups')->findOrFail($id);
    return view('admin.queries.show', compact('query'));
}


    

    public function destroy($id)
    {
        $query = Queries::findOrFail($id);
        $query->delete();

        return redirect()->route('admin.queries.index')->with('success', 'Query deleted successfully.');
    }
}
