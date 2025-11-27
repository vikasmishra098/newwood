<?php

namespace App\Http\Controllers\subadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Followup;
use App\Models\Queries;
use Carbon\Carbon;

class FollowupController extends Controller
{
     public function index(Request $request)
{
    $filter = $request->get('filter', 'today'); 
    $today = \Carbon\Carbon::today();
    $yesterday = \Carbon\Carbon::yesterday();

    if ($filter === 'yesterday') {
        $followups = Followup::with('relatedQuery')
            ->whereDate('fdate', $yesterday)
            ->get();
    } elseif ($filter === 'closed') {
        $followups = Followup::with('relatedQuery')
            ->whereDate('fdate', '<', $today->copy()->subDays(7))
            ->get();
    } elseif ($filter === 'all') {
        $followups = Followup::with('relatedQuery')->get(); // ðŸ‘ˆ All records
    } else { 
        // default â†’ today
        $followups = Followup::with('relatedQuery')
            ->whereDate('fdate', $today)
            ->get();
    }

    return view('admin.followups.index', compact('followups', 'filter'));
}



public function view($queryId)
{
    $query = Queries::with('followups')->findOrFail($queryId);
    return view('admin.followups.view', compact('query'));
}



public function getFollowupsJson()
{
    $followups = Followup::with('relatedQuery')->orderByDesc('id')->get();
    return response()->json($followups);
}


    public function create($query_id)
    {
        $query = Queries::findOrFail($query_id);
        return view('subadmin.followups.create', compact('query'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'query_id' => 'required|exists:queries,id',
            'fdate' => 'required|date',
            'fcomment' => 'required|string',
        ]);

        Followup::create($request->all());

        return redirect()->route('subadmin.followups.index')->with('success', 'Followup added successfully.');
    }

    public function edit($id)
    {
        $followup = Followup::findOrFail($id);
        return view('admin.followups.edit', compact('followup'));
    }

    public function update(Request $request, $id)
    {
        $followup = Followup::findOrFail($id);

        $request->validate([
            'fdate' => 'required|date',
            'fcomment' => 'required|string',
        ]);

        $followup->update($request->all());

        return redirect()->route('subadmin.followups.index')->with('success', 'Followup updated.');
    }
}
